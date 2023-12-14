<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
                ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
                ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                ->orderBy('tbl_booking.created_at', 'desc')->get();

        // dd($book);
        return view('admin.appointment.bill')->with(compact('book','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
