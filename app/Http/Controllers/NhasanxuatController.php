<?php

namespace App\Http\Controllers;

use App\Nhasanxuat;
use Illuminate\Http\Request;

class NhasanxuatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supp['supp'] = Nhasanxuat::paginate(10);
        return view('Nhacungcap.show', $supp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Nhacungcap.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supp = new Nhasanxuat();
        $supp['TenNSX'] = $request->TenNSX;
        $supp['Email'] = $request->Email;
        $supp['SDT'] = $request->SDT;
        $supp['address'] = $request->address;
        $supp->save();
        return redirect()->intended('/listnhacungcap')->with('success','Thêm thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nhasanxuat  $nhasanxuat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supp['supp'] = Nhasanxuat::find($id);
        return view('Nhacungcap.edit', $supp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nhasanxuat  $nhasanxuat
     * @return \Illuminate\Http\Response
     */
    public function edit(Nhasanxuat $nhasanxuat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nhasanxuat  $nhasanxuat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supp = Nhasanxuat::find($id);
        $supp['TenNSX'] = $request->TenNSX;
        $supp['Email'] = $request->Email;
        $supp['SDT'] = $request->SDT;
        $supp['address'] = $request->address;
        $supp->save();
        return redirect()->intended('/listnhacungcap')->with('success','Sửa thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nhasanxuat  $nhasanxuat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            return redirect()->intended('/listnhacungcap')->with('error','Không thể xóa nhà cung cấp');
    }
}
