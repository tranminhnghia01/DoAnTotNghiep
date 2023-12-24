<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Housekeeper;
use App\Models\Service;
use Illuminate\Http\Request;
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
        $house = Housekeeper::paginate(4);
        $list_service = Service::all();
        return view('frontend.index')->with(compact('list_service','service','house'));
    }

   public function service(){
    $service = Service::all();
    return view('frontend.pages.list-service')->with(compact('service'));
   }

   public function housekeeper(){
    $housekeeper = Housekeeper::where('status',0)->get();
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
        return view('frontend.pages.housekeeper-details')->with(compact('housekeeper','comment','avg'));
   }

}
