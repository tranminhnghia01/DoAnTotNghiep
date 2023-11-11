<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// session_start();


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = Payment::all();
        return view('frontend.cart.cart')->with(compact('payment'));
    }


    public function add_Cart(Request $request, $id)
    {
        $weight = $request->weight;
        $product = Product::findOrFail($id);

        // dd($product);
        $data = [
            'id' => $product->product_id,
            'qty' => $weight,
            'name' => $product->product_name,
            'weight' => $product->product_qty,
            'price' => $product->product_price,
            'options' => [
                'image' =>  $product->product_image,
                'status' => $product->product_status,
            ],
        ];

       Cart::add($data);
        return redirect()->route('home.show-cart');
    }

    public function show_Cart() {
        $payment = Payment::all();
        return view('frontend.cart.cart')->with(compact('payment'));
    }

    public function save_Cart(Request $request){
        $data = $request->all();
        $payment_id = $request->payment_id;
        $coupon_code = $request->coupon_code;
        $order_total = $request->order_total;
        if(empty($coupon_code)){
            $coupon_id = 0;
        }else{
            $coupon = Coupon::where('coupon_code',$data['coupon_code'])->first();
            $coupon_id  = $coupon->id;
        }

        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $shipping = Shipping::where('user_id', $user_id)->first();

        $shipping_code = substr(md5(microtime()),rand(0,26),5);

        $order_info = [
            'order_address' => $shipping->shipping_address,
            'user_id' => $user_id,
            'payment_id' => $request->payment_id,
            'coupon_id' => $coupon_id,
            'shipping_id' => $shipping->id,
            'order_code' => $shipping_code,
            'order_total'=> $order_total,
            'order_notes' => $shipping->shipping_notes,
            'order_status' => 1,
        ];

        $order = Order::create($order_info);
        if ($order) {
            $cart = Cart::content();
            foreach ($cart as $key => $value) {
                $order_detail =[
                    'order_code' => $order->order_code,
                    'product_id' =>$value->id,
                    'product_price'=> $value->price,
                    'product_sales_qty' =>$value->qty,
                    'product_name'=>$value->name,
                ];
                $order_details = OrderDetails::create($order_detail);
            };
            Cart::destroy();
            Session::forget('coupon');
            $msg = 'Đặt hàng thành công';
            $style = 'success';
            return redirect()->back()->with('success','');

        }

    }


    public function quantity_change(Request $request)
    {
        $qty = $request->qty;
        $cart = Cart::content();
        foreach ($cart as $key => $value) {
            if ($value->id == $request->product_id) {
                if ($qty == 0) {
                    Cart::remove($value->rowId);
                }else{
                    $value->qty = $qty;
                    Cart::update($value->rowId,$qty);
                }
            }
        }
    }
}
