<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupon::all();
        return view('admin.coupon.index')->with(compact('data'));
    }

    public function store(CouponRequest $request)
    {
        $data =$request->all();

        if (Coupon::create($data)) {
            $style = 'success';
            $msg = 'Thêm mã giảm giá thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi thêm mã giảm giá. ';
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
        $data = Coupon::all();
        $coupon =Coupon::FindOrFail($id);
        if ($coupon) {
           return view('admin.coupon.index')->with(compact('coupon','data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $data = $request->all();
        $coupon = Coupon::find($id);
        if ($coupon->update($data)) {
            $style = 'success';
            $msg = 'Cập nhật mã giảm giá thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗ xảy ra khi cập nhật mã giảm giá. ';
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
        $coupon = Coupon::find($id);
        if ($coupon->delete()) {
            $style = 'success';
            $msg = 'Xóa mã giảm giá thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi xóa mã giảm giá. ';
        };
    }
}
