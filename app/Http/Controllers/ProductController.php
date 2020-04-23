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
        // $prod['soluong'] = $request->soluong;
        $prod['soluong'] = 1;
        $prod['price_after'] = $request->price_after;
        $prod['price_before'] = $request->price_before;
        $prod['id_supplier'] = $request->id_supplier;
        $prod['ngaysx'] = $request->ngaysx;
        $prod['ngayhh'] = $request->hansudung;
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
        // $prod['soluong'] = $request->soluong;
        // $prod['soluong'] = 1;
        $prod['dvt'] = $request->dvt;
        $prod['id_category'] = $request->id_category;
        $prod['ngaysx'] = $request->ngaysx;
        $prod['ngayhh'] = $request->hansudung;
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
        $date = date('Y-m-d');
        $prod = Product::where([['status', 1], ['ngayhh','>=', $date]])->get();
        return $prod;
    }

    public function loadProduct($id){
        $product = product::find($id);
        return $product;
        if($product->soluong <= 0){
            return response()->json(['mess' => 401]);
        }
        return $product;
    }

    public function checkLoadProd($id){
        $product = product::find($id);
        if($product->soluong < 0){
            return response()->json(['mess' => 401]);
        }
        return $product;
    }
    public function checkProduct($id){
        if($id == 0){
            return 0;
        }
        else{
            $product = product::find($id);
            return $product->soluong;
        }
    }

    public function changeStatusProduct($id){
        $product = product::find($id);
        $product->status == 0 ? $product->status = 1 : $product->status = 0;
        $product->save();
        return redirect()->back();
    }

    public function checkProductNhap($id){
        return product::find($id);
    }

    public function conhsd(){
        $now = date('Y-m-d');
        $prod['prod'] = product::with(['category', 'supplier'])
                        ->where('ngayhh', '>', $now)
                        ->paginate(10);
        return view('products.conhsd', $prod);
    }
    public function hethan(){
        $now = date('Y-m-d');
        $prod['prod'] = product::with(['category', 'supplier'])
                        ->where('ngayhh', '<', $now)
                        ->paginate(10);
        return view('products.hethan', $prod);
    }
    public function saphethan(){
        $now = date('Y-m-d');
        $prod['prod'] = product::with(['category', 'supplier'])
                        ->where('ngayhh', '=', $now)
                        ->paginate(10);
        return view('products.saphethan', $prod);
    }
    public function conkinhdoanh(){
        $now = date('Y-m-d');
        $prod['prod'] = product::with(['category', 'supplier'])
                        ->where('status', '=', 1)
                        ->paginate(10);
        return view('products.conkinhdoanh', $prod);
    }
    public function ngungkinhdoanh(){
        $now = date('Y-m-d');
        $prod['prod'] = product::with(['category', 'supplier'])
                        ->where('status', '=', 0)
                        ->paginate(10);
        return view('products.ngungkinhdoanh', $prod);
    }
}
