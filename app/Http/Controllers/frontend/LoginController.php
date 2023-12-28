<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HousekeeperRequest;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Housekeeper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Service;
use App\Models\Shipping;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        $city = City::orderBy('city_name','ASC')->get();
        $service =Service::all();
        return view('frontend.user.login')->with(compact('service','city'));
    }

    public function login(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if (Auth::attempt($login)) {
            $msg = "Đăng nhập thành công";
            $style ="success";
        }
        else{
            $msg = "Đăng nhập không thành công";
            $style ="danger";
        }
        return redirect()->route('home.index')->with(compact('msg','style'));
    }

    public function show_register(Request $request){

        $city = City::orderBy('city_name','ASC')->get();
        $service =Service::all();
        return view('frontend.user.register')->with(compact('service','city'));

    }
    public function register(UserRequest $request)
    {

        $data = $request->all();
        $user_id = substr(md5(microtime()),rand(0,26),5);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 3,
            'user_id' => $user_id,

        ]);
        if ($user) {
            $login = [
                'email'=>$request->email,
                'password'=>$request->password,
                'role_id' => 3,
            ];
            $shipping = [
                'user_id' =>$user_id,
                'shipping_name' => $user->name,
                'shipping_email' => $user->email,
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
        $msg = "Đăng xuất thành công";
        $style ="warning";
        return redirect()->route('home.index')->with(compact('msg','style'));
    }


    public function housekeeper() {
        return view('frontend.user.loghouse');
    }

    public function housekeeper_store(HousekeeperRequest $request) {
        $data = $request->all();
        // dd($data);
        $user_id = substr(md5(microtime()),rand(0,26),5);

        $file = $request->image;

        if (!empty($file)) {
            $data['image'] = "housekeeper".$file->getClientOriginalName();
        }

        $info = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(12345678),
            'role_id' => 2,
            'user_id' => $user_id,

        ];
        $user = User::create($info);
        if($user){
            $data['housekeeper_id'] = $user->user_id;

            Housekeeper::create($data);
            $file->move('uploads/users', $data['image']);
            $msg = "Đăng ký gửi thông tin tài khoản thành công! Bạn vui lòng chờ trong khi chúng tôi duyệt tài khoản";
            $style = "success";

            return Redirect()->back()->with(compact('msg','style'));
        }


    }


    public function select_address(Request $request) {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('city_id',$data['ma_id'])->orderby('province_id','ASC')->get();
                    $output.='<option></option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->province_id.'">'."$province->province_name".'</option>';
                }

            }else{
                $select_wards = Ward::where('province_id',$data['ma_id'])->orderby('ward_id','ASC')->get();
                $output.='<option></option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
            echo $output;
        }
    }
}
