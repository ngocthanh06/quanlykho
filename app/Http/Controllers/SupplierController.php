<?php

namespace App\Http\Controllers;
use App\supplier;
use Illuminate\Http\Request;
use App\Http\Requests\editSupplier;
use App\Http\Requests\supplierRequest;
use App\product;

class SupplierController extends Controller
{
    /**
     *  Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supp['supp'] = supplier::paginate(5);
        return view('supplier.show', $supp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(supplierRequest $request)
    {
        $supp = new supplier();
        $supp['TenNCC'] = $request->TenNCC;
        $supp['Email'] = $request->Email;
        $supp['SDT'] = $request->SDT;
        $supp->save();
        return redirect()->intended('/listsupplier')->with('success','Thêm thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id, supplier $supplier)
    {   
        $supp['supp'] = supplier::find($id);
        return view('supplier.edit', $supp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(editSupplier $request, $id)
    {
        $supp = supplier::find($id);
        $supp['TenNCC'] = $request->TenNCC;
        $supp['Email'] = $request->Email;
        $supp['SDT'] = $request->SDT;
        $supp->save();
        return redirect()->intended('/listsupplier')->with('success','Sửa thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, supplier $supplier)
    {
        $supp = supplier::find($id);
        $prod = product::where('id_supplier', $id)->first();
        if(!empty($prod)){
            return redirect()->intended('/listsupplier')->with('error', 'Nhà cung cấp đã tồn tại sản phẩm, vì vậy không thể xóa');
        }
        else{
            $supp->delete();
            return redirect()->intended('/listsupplier')->with('success','Xóa thành công');
        }
    }
}
