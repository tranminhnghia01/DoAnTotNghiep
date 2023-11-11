<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $AllUser = User::where('level',2)->get();
        return view('admin.users.list')->with(compact('AllUser','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();
        $role = Role::all();

        return view('admin.users.create')->with(compact('city','province','ward','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['name'] = $data['firstname'].' '.$data['lastname'];
        $data['password'] = Hash::make($data['password']);

        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        // dd($data);

        if (User::create($data)) {
            if (!empty($file)) {
                $file->move('uploads/users/',$file->getClientOriginalName());
            }
            $style = 'success';
            $msg = 'Thêm tài khoản người dùng thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi thêm tài khoản. ';
        };

        return redirect()->back()->with(compact('msg','style'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $city = City::orderBy('city_name','ASC')->get();
        $province = Province::all();
        $ward = Ward::all();
        $role = Role::where('role_id','!=',0)->get();

        $name = explode(' ',$user->name);
        $first_name = array_pop($name);
        $last_name = implode(' ', $name);

        return view('admin.users.edit')->with(compact('user','first_name','last_name','city','province','ward','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $file = $request->avatar;
        $data['name'] = $data['firstname'].' '.$data['lastname'];

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('uploads/users',$file->getClientOriginalName());
            }
            $style = 'success';
            $msg = 'Cập nhật tài khoản người dùng thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi cập nhật tài khoản. ';
        };

        return redirect()->back()->with(compact('msg','style'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)->delete()) {
            $style = 'success';
            $msg = 'Xóa tài khoản người dùng thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi xóa tài khoản. ';
        };
        return redirect()->back()->with(compact('msg','style'));
    }

    public function Account_Giupviec()
    {
        $role = Role::all();
        $AllUser = User::where('level',1)->get();
        return view('admin.users.user_role_2.list')->with(compact('AllUser','role'));
    }

}
