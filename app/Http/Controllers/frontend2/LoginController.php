<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();
        $category =Category::all();
        return view('frontend.user.login')->with(compact('category','city','province','ward'));
    }

    public function login(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
            'level' => 2,
        ];

        if (Auth::attempt($login)) {
            $msg = "Đăng nhập thành công";
            $style ="success";
        }
        else{
            $msg = "Đăng nhập không thành công";
            $style ="danger";
        }
        // return redirect()->route('home.index')->with(compact('msg','style'));
        return redirect()->back()->with(compact('msg','style'));
    }

    public function show_register(Request $request){

        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();
        $category =Category::all();
        return view('frontend.user.register')->with(compact('category','city','province','ward'));

    }
    public function register(UserRequest $request)
    {

        $data = $request->all();
        $data['level'] = 2;
        $data['name'] = $data['firstname'].' '.$data['lastname'];
        // dd($data);
        $file =  $data['avatar'];
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if ($data['password']) {
            $data['password']=bcrypt($request->password);
        }

        $user = User::create($data);
        if ($user) {
            if (!empty($file)) {
                $file->move('uploads/users/'.$file->getClientOriginalName());
            }
            // ------------------
            $login = [
                'email'=>$request->email,
                'password'=>$request->password,
                'level' => 2,
            ];
            $shipping = [
                'user_id' => $user->id,
                'shipping_name' => $user->name,
                'shipping_email' => $user->email,
                'ward_id' => $user->ward_id,
                'city_id' => $user->city_id,
                'province_id' => $user->province_id,
                'shipping_address' => $user->address,
                'shipping_phone' => $user->phone,
                'shipping_notes' => "-",
            ];
            Shipping::create($shipping);

            if (Auth::attempt($login)) {
                $msg = "Đăng ký người dùng thành công";
                $style ="success";
            }

        }else{
            $msg = "Đăng ký người dùng không thành công";
            $style ="danger";
        };
        return redirect()->back()->with(compact('msg','style'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function select_address(Request $request) {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('city_id',$data['ma_id'])->orderby('province_id','ASC')->get();
                    $output.='<option>--- chọn Tỉnh ---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->province_id.'">'."$province->province_name".'</option>';
                }

            }else{
                $select_wards = Ward::where('province_id',$data['ma_id'])->orderby('ward_id','ASC')->get();
                $output.='<option>--- Chọn Phường/Xã ---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
            echo $output;
        }
    }
}
