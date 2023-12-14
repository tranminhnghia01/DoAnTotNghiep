<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
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

}
