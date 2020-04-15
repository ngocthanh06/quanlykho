<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\editCateRequest;
use App\Http\Requests\dellCate;
use App\product;
class CategoryController extends Controller
{
    /**
     * Display a listing category.
     * ! miss role login
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate['cate'] = category::paginate(10);
        return view('Category.show', $cate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryRequest $request)
    {
        $cate = new Category();
        $cate['name'] = $request->name;
        $cate->save();
        return redirect()->intended('/listCategory')->with('success','Thêm thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id, category $category)
    {   
        $cate['cate'] = category::find($id);
        return view('Category.edit', $cate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(editCateRequest $request, $id)
    {
        $cate = category::find($id);
        $cate['name'] = $request->name;
        $cate->save();
        return redirect()->intended('/listCategory')->with('success','Sửa thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, category $category)
    {
        $cate = category::find($id);
        $prod = product::where('id_category', $id)->first();
        if(!empty($prod)){
            return redirect()->intended('/listCategory')->with('error','Danh mục đã tồn tại sản phẩm, vì vậy không thể xóa');
        }
        else{
            $cate->delete();
            return redirect()->intended('/listCategory')->with('success','xóa thành công');
        }
    }
}
