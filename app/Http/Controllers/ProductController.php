<?php

namespace App\Http\Controllers;

use App\product;
use App\category;
use App\supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod['prod'] = product::with(['category', 'supplier'])->paginate(10);
        return view('products.show', $prod);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $cate['cate']=Category::all();
        $cate['supplier']=supplier::all();
        return view('products.add',$cate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = new Product();
        $prod['name'] = $request->name;
        $prod['id_category'] = $request->id_category;
        $prod['dvt'] = $request->dvt;
        $prod['soluong'] = $request->soluong;
        $prod['price_after'] = $request->price_after;
        $prod['price_before'] = $request->price_before;
        $prod['id_supplier'] = $request->id_supplier;
        $prod->save();
        return redirect()->intended('/listProduct')->with('success','Thêm thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod['prod'] = product::with(['category', 'supplier'])->find($id);
        $prod['cate']=Category::all();
        $prod['supplier']=supplier::all();
        return view('products.edit', $prod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $prod = product::find($id);
        $prod['name'] = $request->name;
        $prod['id_supplier'] = $request->id_supplier;
        $prod['price_before'] = $request->price_before;
        $prod['price_after'] = $request->price_after;
        $prod['soluong'] = $request->soluong;
        $prod['dvt'] = $request->dvt;
        $prod['id_category'] = $request->id_category;
        $prod->save();
        return redirect()->intended('/listProduct')->with('success','Sửa thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = product::find($id);
        $prod->delete();
        return redirect()->intended('/listProduct')->with('success','Xóa thành công'); 
    }

    public function allProduct(){
        $prod = product::all();
        return $prod;
    }
}
