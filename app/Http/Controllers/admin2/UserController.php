<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Province;
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

        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();

        $name = explode(' ',$user->name);
        $first_name = array_pop($name);
        $last_name = implode(' ', $name);

        return view('admin.account-setting.account')->with(compact('user','first_name','last_name','city','province','ward'));
    }

    public function notify()
    {
        return view('admin.account-setting.notify');
    }

    public function connections()
    {
        return view('admin.account-setting.connect');
    }


    public function Upload_Image(Request $request){
        $user_id= Auth::id();
        $user = User::findOrFail($user_id);
        if ($user->avatar != 0) {
            $old_img = $user->avatar;
        }
        // dd($old_img);
        $data = $request->all();
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = rand(0,99).$file->getClientOriginalName();
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('uploads/users',$data['avatar']);
                if($old_img){
                    $path = public_path('uploads/users/'. $old_img);;
                    unlink($path);
                }
            }
            return redirect()->back()->with('msg',__('Update profile success!'));
        }
        else{
            return redirect()->withErrors('Update profile errors.');
        }
    }


    public function update(UserRequest $request, $id)
    {
        $data =$request->all();
        $data['name'] = $data['firstname'].' '.$data['lastname'];
        $user = User::findOrFail($id);
        if($user->update($data)){
            $style = 'success';
            $msg = 'Update profile success! ';
        }else{
            $style = 'warning';
            $msg = 'Update profile errors. ';
        };

        return redirect()->back()->with(compact('msg','style'));
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
