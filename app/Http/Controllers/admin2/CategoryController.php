<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_Category = Category::all();
        return view('admin.categories.index')->with(compact('list_Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_Category = Category::all();
        return view('admin.categories.create')->with(compact('list_Category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $file = $request->category_image;

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['category_image'] = $new_image;
        }

        if (category::create($data)) {
            if(!empty($file)){
                $file->move('uploads/categories',$new_image);
                $style = 'success';
                $msg = 'Create category success! ';
            }
        }else{
            $style = 'warning';
            $msg = 'Create category errors. ';
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_Category = Category::where('id','!=',$id)->get();
        $category =Category::FindOrFail($id);
        if ($category) {
        return view('admin.categories.edit')->with(compact('category','list_Category'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data=$request->all();
        $dataCategory=Category::find($id);
        $file = $request->category_image;

        if(!empty($file)){
            $get_name_image = $file->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.'-'.rand(0,99).'.'.$file->getClientOriginalExtension();
            $data['category_image'] = $new_image;
        }


        if ($dataCategory->update($data)) {
            $msg = "Update category success!";
            $style = "success";
            if(!empty($file)){
                $file->move('uploads/categories',$new_image);
            }
            return  redirect()->route('admin.category.index')->with(compact('msg','style'));
        }
        else{
            $msg = "Update category errors. ";
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
        if (Category::find($id)->delete()) {
            $msg = "Delete category success!";
            $style ="success";
        }
        else{
            $msg = "Delete category errors. ";
            $style ="warning";
        }
        return redirect()->back()->with(compact('msg','style'));
    }
}
