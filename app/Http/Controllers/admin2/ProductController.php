<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Facade\Image;

use Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data= $request->all();
        // dd($data);
        if($request->hasfile('product_image'))
        {
            foreach($request->file('product_image') as $product_image)
            {
                $name = rand(0,99).$product_image->getClientOriginalName();
                $file_images[] = $name;
            }
        }
        $count = count($file_images);
        if ($count <=4) {
            $data['product_image']=json_encode($file_images);
            // dd($data['product_image']);
            $data['created_at'] = date('Y-m-d H:i:s');
            if (Product::create($data)) {
                if($request->hasfile('product_image'))
                    {
                        foreach($request->file('product_image') as $key=> $product_image)
                        {
                            $name = $file_images[$key];
                            $name_2 = "medium".$file_images[$key];
                            $name_3 = "large".$file_images[$key];
                            $path = public_path('uploads/products/'. $name);
                            $path2 = public_path('uploads/products/'. $name_2);
                            $path3 = public_path('uploads/products/'. $name_3);
                            Image::make($product_image)->save(public_path('uploads/products/'.$name));
                            Image::make($product_image)->resize(200, 160)->save(public_path('uploads/products/'.$name_2));
                            Image::make($product_image)->resize(500, 400)->save(public_path('uploads/products/'.$name_3));
                        }
                    }

                $msg = 'Thêm sản phẩm thành công';
                $style = 'success';
            }else{
                $msg = 'Thêm sản phẩm không thành công';
                $style = 'warning';
            }
        }
        else{
            $msg = 'Tối đa 3 hình ảnh sản phẩm';
            $style = 'danger';
        }

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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        // dd($product);
        return view('admin.products.edit')->with(compact('product','categories'));
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
        $data = $request->all();
        $product = Product::findOrFail($id);
        $images_delete = $request->image_delete;
        // dd($images_delete);
        $image_old =json_decode($product->product_image);

        //check empty delete image
        if (!empty($images_delete)) {
            foreach ($image_old as $key => $value) {
                if (in_array($value,$images_delete)) {
                 unset($image_old[$key]);
                // dd($key);
                }
             }
        }
        $file_images = $image_old;
        // dd($file_images);
        //hinh them
        if($request->hasfile('product_image'))
        {
            foreach($request->file('product_image') as $image)
            {
                $name = $image->getClientOriginalName();
                $image_new[] = $name;
            }
            $file_images = array_merge($image_new ,$image_old);
        }
        // dd($file_images);

        $data['product_image']=json_encode($file_images);

        if (count($file_images)<=5 && count($file_images)> 0) {
            // dd($data['product_image']);
            if ($product->update($data)) {
                if($request->hasfile('product_image'))
                {
                    foreach($request->file('product_image') as $key=> $product_image)
                        {
                            $name = $file_images[$key];
                            $name_2 = "medium".$file_images[$key];
                            $name_3 = "large".$file_images[$key];
                            $path = public_path('uploads/products/'. $name);
                            $path2 = public_path('uploads/products/'. $name_2);
                            $path3 = public_path('uploads/products/'. $name_3);
                            Image::make($product_image)->save(public_path('uploads/products/'.$name));
                            Image::make($product_image)->resize(200, 160)->save(public_path('uploads/products/'.$name_2));
                            Image::make($product_image)->resize(500, 400)->save(public_path('uploads/products/'.$name_3));
                        }

                };
                if ($images_delete) {
                    foreach ($images_delete as $key => $value) {
                        $path = public_path('uploads/products/'. $value);
                        $path2 = public_path('uploads/products/medium'. $value);
                            $path3 = public_path('uploads/products/large'. $value);
                        unlink($path);
                        unlink($path2);
                        unlink($path3);
                    }
                }
                $msg = 'Cập nhật sản phẩm thành công';
                $style = 'success';
            return redirect()->route('admin.product.index')->with(compact('msg','style'));

            }else{
                $msg = 'Cập nhật sản phẩm không thành công';
                $style = 'warning';
            }
        }
        else{

            $msg = 'Hình ảnh sản phẩm không vượt quá 4 ';
            $style = 'danger';

        }
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
        $product = Product::find($id);
        $product_image =json_decode($product->product_image);
        if ($product->delete()) {
            foreach($product_image as $value)
            {

                $path = public_path('uploads/products/'. $value);
                        $path2 = public_path('uploads/products/medium'. $value);
                            $path3 = public_path('uploads/products/large'. $value);
                        unlink($path);
                        unlink($path2);
                        unlink($path3);
                //delete file
                unlink($path);
            }


        };
        return redirect()->back()->with(compact('msg','style'));
    }
}
