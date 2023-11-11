<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id= Auth::id();
        $user = User::findOrFail($user_id);
        $role = Role::where('role_id',$user->role_id)->first();

        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();

        $province_id = Ward::find($user->ward_id);
        if ($province_id) {
            $city_id = Province::find($province_id->province_id);
             $country = City::find($city_id->city_id);
        }else{
            $country = 0;
        }


        return view('admin.account.profile')->with(compact('user','city','province','ward','role','country'));
    }






    public function update(Request $request)
    {
        $user_id= Auth::id();
        $user = User::findOrFail($user_id);
        if ($user->image != 0) {
            $old_img = $user->image;
        }else{
            $old_img = "";
        }
        $data = $request->all();
        $file = $request->image;

        if (!empty($file)) {
            $data['image'] = rand(0,99).$file->getClientOriginalName();
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                Image::make($file)->resize(150, 150)->save(public_path('uploads/users/'.$data['image']));
                if($old_img !=""){
                    $path = public_path('uploads/users/'. $old_img);;
                    unlink($path);
                }
            }
            return redirect()->back()->with('msg',__('Cập nhật tài khoản cá nhân thành công!'));
        }
        else{
            return redirect()->withErrors('Update profile errors.');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function select_address(Request $request) {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('city_id',$data['ma_id'])->orderby('province_id','ASC')->get();
                    $output.='<option>--- choose province ---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->province_id.'">'."$province->province_name".'</option>';
                }

            }else{
                $select_wards = Ward::where('province_id',$data['ma_id'])->orderby('ward_id','ASC')->get();
                $output.='<option>--- Choose ward ---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
            echo $output;
        }
    }
    public function show_image(Request $request) {
        echo ($request->all());
    }
}
