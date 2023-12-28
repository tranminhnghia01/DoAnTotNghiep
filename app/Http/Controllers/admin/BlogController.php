<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();
        return view('admin.blog.list')->with(compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();
        $file = $request->blog_image;

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['blog_image'] = $new_image;
        }

        if (Blog::create($data)) {
            if(!empty($file)){
                $file->move('uploads/blogs',$new_image);
                $style = 'success';
                $msg = 'Thành công! Thêm mới bài bài viết ';
            }
        }else{
            $style = 'danger';
            $msg = 'Lỗi hệ thống! Vui lòng kiểm tra lại';


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
        $blog = Blog::find($id);
        return view('admin.blog.edit')->with(compact('blog'));
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
        $dataBlog=Blog::find($id);
        $file = $request->blog_image;

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.'-'.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['blog_image'] = $new_image;
        }


        if ($dataBlog->update($data)) {
            $msg = "Cập nhật bài viết thành công!";
            $style = "success";
            if(!empty($file)){
                $file->move('uploads/blogs',$new_image);
            }
            return  redirect()->route('admin.blog.index')->with(compact('msg','style'));
        }
        else{
            $msg = "Lỗi hệ thống! Vui lòng kiểm tra lại.";
            $style = "danger";
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
        if (Blog::find($id)->delete()) {
            $msg = "Xóa bài viết thành công!";
            $style ="success";
        }
        else{
            $msg = "Lỗi hệ thống! Vui lòng kiểm tra lại.";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
    }
}
