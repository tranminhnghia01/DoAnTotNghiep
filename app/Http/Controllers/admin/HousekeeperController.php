<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Housekeeper;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class HousekeeperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $housekeepers = User::where('role_id',2)->get();
        return view('admin.users.list')->with(compact('housekeepers','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        $role = Role::find(2);

        return view('admin.users.create')->with(compact('city','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user_id = substr(md5(microtime()),rand(0,26),5);

        // dd($data);
        $info = [
            'user_id'=> $user_id,
            'role_id'=>2,
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password' => Hash::make($data['password']),

        ];

        $user = User::create($info);
        if($user){
            $file = $request->image;
            if (!empty($file)) {
                $data['image'] = $file->getClientOriginalName();
            }
            $housekeeper =[
                'housekeeper_id'=> $user->user_id,
                'name'=> $data['name'],
                'image'=> $data['image'],
                'phone'=> $data['phone'],
                'age'=> $data['age'],
                'gender'=> $data['gender'],
                'address'=> $data['address'],
                'des'=> $data['des'],
                'files'=> $data['files'],
                'status'=> 1,
            ];
            if (Housekeeper::create($housekeeper)) {
                if (!empty($file)) {
                    $file->move('uploads/users',$file->getClientOriginalName());
                }
                $style = 'success';
                $msg = 'Thêm tài khoản người giúp việc dùng thành công! ';
            return redirect()->route('admin.housekeeper.index')->with(compact('msg','style'));

            }else{
                $style = 'warning';
                $msg = 'Có lỗi xảy ra khi thêm tài khoản. ';
            };

            return redirect()->back()->with(compact('msg','style'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::all();

        $user = User::where('user_id',$id)->first();
        // dd($user->role_id);
        $role = Role::find($user->role_id);

        $housekeeper = Housekeeper::where('housekeeper_id',$id)->first();
        return view('admin.users.show')->with(compact('housekeeper','role','user','city'));
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
        $data = $request->all();
        $housekeeper = Housekeeper::where('housekeeper_id',$id)->first();
        $file = $request->image;
        // dd($data);

        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
            $old_image =  $housekeeper->image;
        }


        if ($housekeeper->update($data)) {
            if (!empty($file)) {
                $file->move('uploads/users',$file->getClientOriginalName());
                if (!empty($old_image)) {
                    unlink(public_path('uploads/users/'. $old_image));
                }
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
        //
    }
}
