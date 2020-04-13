<?php

namespace App\Http\Controllers;

use App\Nhapkho;
use App\Product;
use App\chitietnhapkho;
use Auth;
use Illuminate\Http\Request;

class NhapKhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Nhap['Nhap'] = Nhapkho::with(['user','chitietnhapkho' => function($q) {
            $q->with(['product'=> function($re){
                $re->with(['category', 'supplier']);
            }]);
        }])->get();
        return view('Nhapkho.show', $Nhap);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod['prod'] = Product::all();
        return view('Nhapkho.add', $prod);
    }

    public function store(Request $request)
    {
        $nhap = new Nhapkho();
        $nhap['user_id'] = Auth::user()->id;
        $nhap['Noidung'] = $request->Noidung;
        $nhap['Tongtien'] = $request->Tongtien;
        $nhap->save();
        $id = $nhap->id;
        $data = $request->except('_token');
        $detai = new chitietnhapkho();
        foreach($data as $key => $value){
                if($detai['id_SP'] != '' && $detai['gianhap'] != '' && $detai['sl'] != '' && $detai['dvt'] != ''){
                    $val = new chitietnhapkho();
                    $val['id_nhapkho'] = $id;
                    $val['id_SP'] = $detai['id_SP'];
                    $val['gianhap'] = $detai['gianhap'];
                    $val['sl'] = $detai['sl'];
                    $val['dvt'] = $detai['dvt'];
                    $val->save();
                    $detai['id_SP'] = '';
                    $detai['gianhap'] = '';
                    $detai['sl'] = '';
                    $detai['dvt'] = '';
                }
                if(strlen(strstr($key, 'idSP'))>0 ){
                    $detai['id_SP'] = $value;
                }
                else if(strlen(strstr($key, 'gianhap'))>0){
                    $detai['gianhap'] = $value;
                }
                else if(strlen(strstr($key, 'sl'))>0){
                    $detai['sl'] = $value;
                }
                else if(strlen(strstr($key, 'dvt'))>0){
                    $detai['dvt'] = $value;
                }
        }
        return redirect()->intended('/Nhapkho')->with('success','Nhập kho thành công'); 
    }

    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NhapKho  $nhapKho
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod['prod'] = Product::all();
        $prod['nhapkho'] = Nhapkho::with('chitietnhapkho')->where('id', $id)->get();
        return view('Nhapkho.edit', $prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NhapKho  $nhapKho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $nhap = Nhapkho::find($id);
        $nhap['user_id'] = Auth::user()->id;
        $nhap['Noidung'] = $request->Noidung;
        $nhap['Tongtien'] = $request->Tongtien;
        $nhap->save();
        $data = $request->except('_token');
        $countCheck = 0;
        foreach($data as $key => $value){
            if(strlen(strstr($key, 'idSP'))>0 ){
                $countCheck++;
            }
        }
        $countnhapkho = chitietnhapkho::where('id_nhapkho', $id)->count();
        if($countCheck > $countnhapkho){
            $detailNew = new chitietnhapkho();
            $detailNew['id_nhapkho'] = $id;
            $detailNew->save();
        }
        $count = 0;
        $detailnhapkho = chitietnhapkho::where('id_nhapkho', $id)->get();
        foreach($detailnhapkho as $key=>$dt){
            $key == 0 ? $count = '' : $count = $key;
            $chitiet = chitietnhapkho::where([['id_nhapkho', $dt['id_nhapkho']],[ 'id_SP',$dt['id_SP']],['gianhap',$dt['gianhap']],['sl',$dt['sl']],['dvt',$dt['dvt']]])
            ->update(['id_nhapkho' => $id, 'id_SP'=>$request['idSP'.$count],'gianhap'=>$request['gianhap'.$count],'sl'=>$request['sl'.$count],'dvt'=>$request["dvt".$count]]);
        }
        return redirect()->intended('/Nhapkho')->with('success','Sửa thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NhapKho  $nhapKho
     * @return \Illuminate\Http\Response
     */
    public function destroy(NhapKho $nhapKho)
    {
        //
    }
}
