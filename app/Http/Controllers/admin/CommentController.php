<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Comment;
use App\Models\Housekeeper;
use App\Models\Service;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $comment = Comment::join('tbl_history', 'tbl_history.history_id', '=', 'tbl_comment.history_id')
        ->get();
        $housekeeper = Housekeeper::where('status',0)->get();
        // dd($comment);
        return view('admin.comment.index')->with(compact('comment','housekeeper'));
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
}
