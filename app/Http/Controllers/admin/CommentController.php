<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        $housekeeper = Housekeeper::all();
        // dd($comment);
        return view('admin.comment.index')->with(compact('comment','housekeeper'));
    }

    public function banggia(){

        $service = Service::all();
        return view('admin.service.banggia')->with(compact('service'));
    }
}
