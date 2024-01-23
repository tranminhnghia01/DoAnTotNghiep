<?php

namespace App\Http\Controllers\Housekeeper;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\City;
use App\Models\History;
use App\Models\Housekeeper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function profile(){
        $city = City::all();

        $id= Auth::id();
        $user = User::findOrFail($id);;
        $role = Role::find($user->role_id);

        $housekeeper = Housekeeper::where('housekeeper_id',$user->user_id)->first();
        return view('housekeeper.profile')->with(compact('housekeeper','role','user','city'));
     }

     public function confirm(){
        $city = City::all();
        $id= Auth::id();
        $user = User::findOrFail($id);
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking_details.payment_id')
        ->join('tbl_wishlist', 'tbl_wishlist.wishlist_id', '=', 'tbl_booking.wishlist_id')
        ->where('book_status',1)
        ->where('tbl_wishlist.housekeeper_id',$user->user_id)
        ->get();

        // dd($book);
        return view('housekeeper.confirm-bill')->with(compact('book','user'));
     }
    public function index()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
            ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')
            ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
            ->where('housekeeper_id',$user->user_id)->get();
            // dd($book);
        return view('housekeeper.index')->with(compact('book','user'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking_details.payment_id')
        ->where('wishlist_id',null)
        ->where('book_status',1)->orderBy('tbl_booking.created_at', 'desc')
        ->get();

        return view('housekeeper.appointment-new')->with(compact('book','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($book_id)
    {
        $id= Auth::id();
        $user = User::findOrFail($id);
        $housekeeper = Housekeeper::where('housekeeper_id',$user->user_id)->first();
        $book = Book::where('book_id',$book_id)->first();

        if($book->update(['book_status'=>2])){
            $info = [
                'book_id' => $book_id,
                	'housekeeper_id' => $user->user_id,
                    	'history_status'	=>$book->book_status,

            ];
            $history =History::create($info);
            if ($history) {
                $msg = "Nhận việc thành công";
                $style = "success";

            }
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
        //
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
        //
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
