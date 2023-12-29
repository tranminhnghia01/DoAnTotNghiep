<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HousekeeperRequest;
use App\Models\City;
use App\Models\History;
use App\Models\Housekeeper;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class HousekeeperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Role::all();
        $housekeeper = Housekeeper::join('users', 'users.user_id', '=', 'tbl_housekeeper.housekeeper_id')
        ->join('tbl_role','tbl_role.role_id','=','users.role_id')->orderBy('status', 'desc')->get();
        // dd($housekeepers);
        return view('admin.users.list')->with(compact('housekeeper','role'));
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
    public function store(HousekeeperRequest $request)
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
                $data['image'] = "GV".$file->getClientOriginalName();
            }else{
                $data['image'] = "";
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
                'status'=> $data['status'],
            ];
            if (Housekeeper::create($housekeeper)) {
                if (!empty($file)) {
                    $file->move('uploads/users',$data['image']);
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


    public function show($id)
    {
        $city = City::all();

        $user = User::where('user_id',$id)->first();
        $role = Role::find($user->role_id);

        $housekeeper = Housekeeper::join('users', 'users.user_id', '=', 'tbl_housekeeper.housekeeper_id')
        ->join('tbl_role','tbl_role.role_id','=','users.role_id')->where('housekeeper_id',$id)->first();

        $book = History::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_booking_details.book_id')->where('tbl_history.housekeeper_id',$id)->get();

        return view('admin.users.show')->with(compact('housekeeper','role','user','city','book'));
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
        $user = User::where('user_id',$id)->first();
        $user->update(['name'=> $data['name'],]);

        $file = $request->image;
        // dd($data);

        if (!empty($file)) {
            $data['image'] = "GV".$file->getClientOriginalName();
            $old_image =  $housekeeper->image;
        }


        if ($housekeeper->update($data)) {
            if (!empty($file)) {
                $file->move('uploads/users',$data['image']);
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
    // public function show_Details($housekeeper_id)
    // {
    //     $housekeeper = User::where('user_id',$housekeeper_id)
    //     ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'users.user_id')->first();
    //     // dd($housekeeper);
    //     $book = History::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_history.book_id')
    //     ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_booking_details.book_id')->where('tbl_history.housekeeper_id',$housekeeper_id)->get();

    //     return view('admin.users.appointmet-housekeeper')->with(compact('book','housekeeper'));
    // }

    public function showfe(Request $request,$housekeeper_id){
            $housekeeper = Housekeeper::where('housekeeper_id',$housekeeper_id)->first();
            $housekeeper->update(['content'=>$request->content]);
            $msg = 'Cập nhật chi tiết thành công';
            $style = 'success';
            return redirect()->back()->with(compact('msg','style'));
    }
}
