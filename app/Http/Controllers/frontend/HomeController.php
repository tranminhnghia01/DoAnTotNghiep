<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\HousekeeperRequest;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Housekeeper;
use App\Models\Infomation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::paginate(6);
        $housekeeper = Housekeeper::paginate(4);
        $list_service = Service::all();

        $comment_home = Comment::where('rate',5)->get();
        return view('frontend.index')->with(compact('list_service','service','housekeeper','comment_home'));
    }



   public function housekeeper(){
        $id= Auth::id();
        // $user = User::findOrFail($id);
    // $housekeeper = Housekeeper::where('h',0)->paginate(8);
    return view('frontend.pages.list-housekeeper')->with(compact('housekeeper'));
   }

   public function housekeeper_show($housekeeper_id){
        $housekeeper = Housekeeper::where('housekeeper_id',$housekeeper_id)->first();
        $comment = Comment::join('tbl_history', 'tbl_history.history_id', '=', 'tbl_comment.history_id')
        ->where('tbl_history.housekeeper_id',$housekeeper_id)->get();

        $sum_rate = 0;
        $avg = 0;
        foreach ($comment as $key => $value) {
            $sum_rate += $value->rate;
            $avg = $sum_rate/($key+1);
        }
        $previous = Housekeeper::where('housekeeper_id', '<', $housekeeper->housekeeper_id)->max('housekeeper_id');
        // get next user id
        $next = Housekeeper::where('housekeeper_id', '>', $housekeeper->housekeeper_id)->min('housekeeper_id');
        return view('frontend.pages.housekeeper-details')->with(compact('housekeeper','comment','avg','previous','next'));
   }

   public function create() {
        // $housekeeper = Housekeeper::where('status',0)->paginate(8);
        return view('frontend.user.loghouse');
    }

    public function store(HousekeeperRequest $request) {
        $data = $request->all();
        // dd($data);
        // $user_id = substr(md5(microtime()),rand(0,26),5);
        $id= Auth::id();
        $user = User::findOrFail($id);

        $file = $request->image;

        if (!empty($file)) {
            $data['image'] = "housekeeper".$file->getClientOriginalName();
        }


            $data['housekeeper_id'] = $user->user_id;

            Housekeeper::create($data);
            $file->move('uploads/users', $data['image']);
            $msg = "Đăng ký gửi thông tin tài khoản thành công! Bạn vui lòng chờ trong khi chúng tôi duyệt tài khoản";
            $style = "success";

            return Redirect()->back()->with(compact('msg','style'));


    }
    public function lienhe(){
        $infomation = Infomation::first();
        return view('frontend.pages.contact')->with(compact('infomation'));
    }
    public function lienhe_store(ContactRequest $request){
        $data = $request->all();
        $contact = Contact::create($data);
        if($contact){
            $msg ='Câu hỏi của bạn được gửi thành công, Chúng tôi sẽ xem xét và phản hồi lại bạn sau';
            $style = 'success';
        }else{

            $msg ='Đã có lỗi xảy ra! Vui lòng kiểm tra lại thông tin và thử lại sau.';
            $style = 'danger';
        }

        return redirect()->back()->with(compact('msg','style'));
    }



}
