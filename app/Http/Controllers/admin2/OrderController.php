<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();
        $order = Order::all();
        $book_new = Book::where('book_status',1)->OrderBy('created_at','desc')->get();
        $order_new = Order::where('order_status',1)->OrderBy('created_at','desc')->get();
        return view('admin.order.index')->with(compact('book','order','book_new','order_new'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $orderDetails = OrderDetails::where('order_code', $order_code)->get();
        $shipping = Shipping::where('user_id',$order->user_id)->first();
        $payment = Payment::find($order->payment_id);
        $coupon = Coupon::find($order->coupon_id);

        return view('admin.order.details')->with(compact('order','orderDetails','shipping','payment','coupon'));
    }

    public function show_book(Request $request, $book_code)
    {
        $book = Book::where('book_code', $book_code)->first();
        $shipping = Shipping::where('user_id',$book->shipping_id)->first();
        $payment = Payment::find($book->payment_id);
        return "Đặt lịch";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
