<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Housekeeper;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class AccountController extends Controller
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


        return view('admin.account.profile')->with(compact('user','city','province','ward','role'));
    }

    public function update(Request $request)
    {
        $user_id= Auth::id();
        $user = User::findOrFail($user_id);

        $data = $request->all();
        // dd($data);

        if ($user->update($data)) {
            $msg = 'Cập nhật tài khoản cá nhân thành công!';
            $style = 'success';
        }
        else{
            $msg = 'Có lỗi xảy ra khi tiến hành cập nhật tài khoản! Vui lòng kiểm tra lại.';
            $style = 'warning';
        }
        return redirect()->back()->with(compact('msg','style'));

    }




    // public function update(Request $request)
    // {
    //     $user_id= Auth::id();
    //     $user = User::findOrFail($user_id);
    //     if ($user->image != 0) {
    //         $old_img = $user->image;
    //     }else{
    //         $old_img = "";
    //     }
    //     $data = $request->all();
    //     $file = $request->image;

    //     if (!empty($file)) {
    //         $data['image'] = rand(0,99).$file->getClientOriginalName();
    //     }
    //     // dd($data);

    //     if ($user->update($data)) {
    //         if (!empty($file)) {
    //             Image::make($file)->resize(150, 150)->save(public_path('uploads/users/'.$data['image']));

    //         }
    //         return redirect()->back()->with('msg',__('Cập nhật tài khoản cá nhân thành công!'));
    //     }
    //     else{
    //         return redirect()->withErrors('Update profile errors.');
    //     }
    // }

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



    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


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


    public function register_house(Request $request)
    {

        $housekeeper = Housekeeper::where('status',1)->orderBy('created_at', 'desc')->get();
        // dd($housekeeper);
        return view('admin.users.register')->with(compact('housekeeper'));
    }
    public function register_destroy($user_id){
        $housekeeper = Housekeeper::where('housekeeper_id', $user_id)->first();
        if($housekeeper){
            $housekeeper->delete();

            $msg = 'Xóa đơn yêu cầu thành công';
            $style = 'success';
            return redirect()->back()->with(compact('msg','style'));
        };
    }

}
