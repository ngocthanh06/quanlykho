<?php

namespace App\Http\Controllers;

use App\Nhapkho;
use App\Nhasanxuat;
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
        $Nhap['Nhap'] = Nhapkho::with(['user','nhasanxuat','chitietnhapkho' => function($q) {
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
        $date = date('Y-m-d');
        $prod['prod'] = Product::where([['status', 1], ['ngayhh','>=', $date]])->get();
        $prod['nhasx'] = Nhasanxuat::all();
        return view('Nhapkho.add', $prod);
    }

    public function store(Request $request)
    {
        $nhap = new Nhapkho();
        $nhap['id_nhasx'] = $request->nhasx;
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
                    $this->updateProduct($detai['id_SP'], $detai['sl'],$detai['dvt'],$detai['gianhap'],'add');
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
        $prod['nhasx'] = Nhasanxuat::all();
        $prod['prod'] = Product::all();
        $prod['id'] = $id;
        $prod['nhapkho'] = Nhapkho::with('chitietnhapkho')->where('id', $id)->get();
        // return $prod['nhapkho'];
        return view('Nhapkho.edit', $prod);
    }

    /**
     * Update nhập kho.
     *
     * - Lưu thông tin nhập kho
     * - lọc và lấy từng chi tiết của nhập kho
     * TH1: Nếu người dùng add mới thì tạo mới 1 cái rồi duyệt update
     * TH2: Nếu người dùng xóa thì gắng giá trị lấy từ csdl so sánh với input chọn ra mảng dư vừa lấy xóa
     * - Cập nhập trong danh sách product
     * @param nhap: giá trị nhập kho 
     * @param  num : giá trị số lượng thêm vào trừ đi 1
     * @param detainhapkho: dữ liệu chi tiết nhập kho
     * @param countnhapkho: số lượng các sp tồn tại trong chi tiết nhập kho
     * * foreach($data as $key => $value) : Lấy số lượng phần tử sản phẩm được truyền từ request
     * * foreach($detailnhapkho as $key=>$dt) : Lưu phần tử vào csdl
     */
    public function update(Request $request,$id)
    {
        $nhap = Nhapkho::find($id);
        $count = 0;$countCheck = 0;
        $nhap['id_nhasx'] = $request->nhasx;
        $nhap['user_id'] = Auth::user()->id;
        $nhap['Noidung'] = $request->Noidung;
        $nhap['Tongtien'] = $request->Tongtien;
        $nhap->save();
        $data = $request->except('_token');
        $countnhapkho = chitietnhapkho::where('id_nhapkho', $id)->count();
        foreach($data as $key => $value){
            if(strlen(strstr($key, 'idSP'))>0 ){
                $countCheck++;
            }
        }
        while($countCheck > $countnhapkho){
            $num = $countCheck - 1;
            $this->updateProduct($request['idSP'.$num], $request['sl'.$num],$request['dvt'.$num],$request['gianhap'.$num], 'add');
            $detailNew = new chitietnhapkho();
            $detailNew['id_nhapkho'] = $id;
            $detailNew['id_SP'] = $request['idSP'.$num];
            $detailNew['gianhap'] = $request['gianhap'.$num];
            $detailNew['sl'] = $request['sl'.$num];
            $detailNew['dvt'] = $request['dvt'.$num];
            $detailNew->save();
            $countCheck--;
        }
        $detailnhapkho = chitietnhapkho::where('id_nhapkho', $id)->get();        
        foreach($detailnhapkho as $key=>$dt){
            $key == 0 ? $count = '' : $count = $key;
            $prod = chitietnhapkho::where([['id_nhapkho', $dt['id_nhapkho']],[ 'id_SP',$dt['id_SP']],['gianhap',$dt['gianhap']],['sl',$dt['sl']],['dvt',$dt['dvt']]])->first();
            if($prod['sl'] < $request['sl'.$count]){
                $p = Product::find($dt['id_SP']);
                $p['soluong'] = $p['soluong'] + ($request['sl'.$count] - $prod['sl']);
                Product::where('id', $dt['id_SP'])->update(['soluong'=> $p['soluong']]);
            }
            else if($prod['sl'] > $request['sl'.$count]){
                $p = Product::find($dt['id_SP']);
                $p['soluong'] = $p['soluong'] - ($prod['sl'] - $request['sl'.$count] );
                Product::where('id', $dt['id_SP'])->update(['soluong'=> $p['soluong']]);
            }
            $this->updateProduct($request['idSP'.$count], $request['sl'.$count],$request['dvt'.$count],$request['gianhap'.$count], 'add');
            $chitiet = chitietnhapkho::where([['id_nhapkho', $dt['id_nhapkho']],[ 'id_SP',$dt['id_SP']],['gianhap',$dt['gianhap']],['sl',$dt['sl']],['dvt',$dt['dvt']]])
            ->update(['id_nhapkho' => $id, 'id_SP'=>$request['idSP'.$count],'gianhap'=>$request['gianhap'.$count],'sl'=>$request['sl'.$count],'dvt'=>$request["dvt".$count]]);
        }
        return redirect()->back()->with('success','Sửa thành công');
    }
    
    /**
     * Update soluong product
     */

    public function updateProduct($idProduct, $soluong, $dvt, $gianhap, $condition){
        $product = Product::find($idProduct);
        $sl = 0;
        if($condition == 'add'){
            $sl = $product['soluong'] + $soluong;
        }
        else{
            $sl = $product['soluong'] - $soluong;
        }
        Product::where('id', $idProduct)->update(['soluong' => $sl,'dvt'=>$dvt,'price_before'=>$gianhap]);
    }

    /**
     * Update soluong product
     */

    public function updateRemoveProduct($idProduct, $soluong){
        $product = Product::find($idProduct);
        $sl = 0;
            $sl = $product['soluong'] - $soluong;
        Product::where('id', $idProduct)->update(['soluong' => $sl]);
    }

    /**
     * Xóa chi tiết sản phẩm trong nhapkho
     */
    public function removeDetailProduct(Request $request){
        $Nhap = Nhapkho::find($request['id']);
        $Nhap['Tongtien'] = $request['tongtien'];
        $Nhap->save();
        $this->updateRemoveProduct($request['idSP'], $request['sl']);
        chitietnhapkho::where([['id_nhapkho', $request['id']],[ 'id_SP',$request['idSP']],['gianhap',$request['gianhap']],['sl',$request['sl']],['dvt',$request['dvt']]])->delete();
        return response()->json(['code' => 200]);
    }

    public function listSpNhapKho(){
        $list['list'] = chitietnhapkho::with(['product' => function($q){
            $q->with('supplier');
        }])->get();
        return view('Nhapkho.list', $list);
    }


    public function destroy(NhapKho $nhapKho)
    {
        //
    }
}
