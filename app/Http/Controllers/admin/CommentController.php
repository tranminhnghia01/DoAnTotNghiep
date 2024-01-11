<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Mail\MailCoupon;
use App\Mail\MailThanks;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Housekeeper;
use App\Models\Service;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Mail;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $comment = Comment::join('tbl_history', 'tbl_history.history_id', '=', 'tbl_comment.history_id')->orderBy('tbl_comment.created_at','desc')
        ->get();
        // $housekeeper = Housekeeper::where('status',0)->get();
        // dd($comment);
        return view('admin.comment.index')->with(compact('comment'));
    }

    public function reply(ReplyRequest $request,$comment_id){
        $comment = Comment::findOrFail($comment_id);
        $reply = $request->reply;
        if($reply == ""){
            $msg = "Có lỗi xảy ra! Vui lòng kiểm tra lại";
            $style ="danger";

        }else{
            $comment->update(['reply'=>$reply]);
            $msg = "Bình luận thành công";
            $style ="success";
        };

        return redirect()->back()->with(compact('msg','style'));

    }

    public function banggia(){

        $service = Service::all();
        return view('admin.service.banggia')->with(compact('service'));
    }

    public function change_status_comment(Request $request){

        $data = $request->all();

        $comment = Comment::find($data['comment_id']);
        $comment->update(['status'=>$data['status']]);

        echo 'Thành công';
    }

    public function thanks($comment_id){
        // dd($comment_id);
        $comment = Comment::find($comment_id);
            Mail::to('minhnghia11a1@gmail.com')->send(new MailThanks($comment));


            $msg = 'Gửi thư cảm ơn thành công';
            $style ='success';
            return redirect()->back()->with(compact('msg','style'));


    }

}
