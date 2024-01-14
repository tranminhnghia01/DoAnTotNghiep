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

        $user = User::where('email',$data['email'])->first();
        if($user){
            $user_id = $user->user_id;
            $shipping = Shipping::where('user_id',$user_id)->first();

            if($shipping && Auth::attempt($login)){
                $msg = "Đăng nhập thành công";
                $style ="success";
            }
            else{
                $msg = "Đăng nhập không thành công";
                $style ="danger";
            }
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



    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // dd($request->all());
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            $msg = "Mật khẩu cũ không khớp!";
            $style = "danger";
        return back()->with(compact('msg','style'));

        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
            $msg = "Đã đổi mật khẩu thành công!";
            $style = "success";

        return back()->with(compact('msg','style'));
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
