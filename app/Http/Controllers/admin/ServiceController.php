<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Image;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view("admin.service.index")->with(compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $file = $request->service_image;

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['service_image'] = $new_image;
        }

        // dd($data);

        if (Service::create($data)) {
            if(!empty($file)){
                Image::make($file)->save(public_path('uploads/services/'. $new_image));

                $style = 'success';
                $msg = 'thêm mới dịch vụ thành công! ';
            }
        }else{
            $style = 'warning';
            $msg = 'Đã có lỗi xảy ra khi thêm! Vui lòng thử lại. ';
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
        $service = Service::find($id);
        return view('admin.service.edit')->with(compact('service'));
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
        $data=$request->all();
        $service=Service::find($id);
        $file = $request->service_image;
        if(empty($data['service_status'])){
            $data['service_status'] ="off";
        }

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.'-'.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['service_image'] = $new_image;
            $old_img = $service->service_image;

        }

        // dd($data);

        if ($service->update($data)) {
            $msg = "Update service success!";
            $style = "success";
            if(!empty($file)){
                $file->move('uploads/services',$new_image);
                if($old_img){
                    $path = public_path('uploads/services/'. $old_img);;
                    unlink($path);
                }
            }
            return  redirect()->route('admin.service.index')->with(compact('msg','style'));
        }
        else{
            $msg = "Update service errors. ";
            $style = "warning";
            return redirect()->back()->with(compact('msg','style'));
        }
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
