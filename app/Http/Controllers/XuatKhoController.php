<?php

namespace App\Http\Controllers;

use App\xuatKho;
use App\product;
use App\detaixuatkho;
use App\Client;
use Auth;
use Illuminate\Http\Request;

class XuatKhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xuatkho['xuat'] = xuatkho::with('user', 'client', 'detaixuatkho')->get();
        return view('xuatkho.show',$xuatkho);
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
        $prod['client'] = Client::all();
        return view('xuatkho.add', $prod);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idCLient = $request->name;
        if($request->phone && $request->address && $request->email)
        {
            $client = Client::create(['name' => $request->name, 
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email]);
            $idCLient = $client->id;
        }
        $xuatkho = xuatkho::create(['user_id' => Auth::user()->id, 
            'client_id' => $idCLient, 
            'Noidung' => $request->Noidung,
            'Tongtien'=> $request->Tongtien]);
        $idXuatkho = $xuatkho->id;
        $data = $request->except('_token');
        $detai = new detaixuatkho();
        foreach($data as $key => $value){
            if($detai['id_SP'] != '' && $detai['giaxuat'] != '' && $detai['sl'] != ''){
                detaixuatkho::create(['id_xuatkho'=>$idXuatkho, 
                'id_SP'=> $detai['id_SP'],
                'sl' => $detai['sl'],
                'giaxuat' => $detai['giaxuat']]);
                $this->updateProduct($detai['id_SP'], $detai['sl'], 'remove');
                $detai['id_SP'] = '';
                $detai['giaxuat'] = '';
                $detai['sl'] = '';
            }
            if(strlen(strstr($key, 'idSP'))>0 ){
                $detai['id_SP'] = $value;
            }
            else if(strlen(strstr($key, 'giaxuat'))>0){
                $detai['giaxuat'] = $value;
            }
            else if(strlen(strstr($key, 'sl'))>0){
                $detai['sl'] = $value;
            }
        }
        return redirect()->intended('/xuatkho')->with('success','Xuất kho thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\xuatKho  $xuatKho
     * @return \Illuminate\Http\Response
     */
    public function show(xuatKho $xuatKho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\xuatKho  $xuatKho
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod['prod'] = product::all();
        $prod['client'] = Client::all();
        $prod['id'] = $id;
        $prod['detail'] = xuatKho::with('detaixuatkho', 'client')->where('id', $id)->first();
        // return $prod['detail'];
        return view('xuatkho.edit', $prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\xuatKho  $xuatKho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $countCheck = 0; $count = 0; $add = 0;
        $idCLient = $request->name;
        if($request->phone && $request->address && $request->email)
        {
            $client = Client::where('id', $idCLient)->update(['name' => $request->name, 
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email]);
            $idCLient = $client->id;
        }
        $xuatkho = xuatkho::where('id', $id)->update(['user_id' => Auth::user()->id, 
            'client_id' => $idCLient, 
            'Noidung' => $request->Noidung,
            'Tongtien'=> $request->Tongtien]);
        $data = $request->except('_token');
        $countxuatkho = detaixuatkho::where('id_xuatkho', $id)->count();
        foreach($data as $key => $value){
            if(strlen(strstr($key, 'idSP'))>0 ){
                $countCheck++;
            }
        }
        $idCheck = $countxuatkho;
        while($countCheck > $countxuatkho){
            $num = $countCheck - 1;
            $this->updateProduct($request['idSP'.$idCheck], $request['sl'.$idCheck], 'remove');
            detaixuatkho::create(['id_xuatkho'=>$id, 
                'id_SP'=> $request['idSP'.$idCheck],
                'sl' => $request['sl'.$idCheck],
                'giaxuat' => $request['giaxuat'.$idCheck]]);
            $add = $num;
            $idCheck++;
            $countCheck--;
        }
        $detailxuatkho = detaixuatkho::where('id_xuatkho', $id)->get();     
        foreach($detailxuatkho as $key=>$dt){
            $key == 0 ? $count = '' : $count = $key;
                $prod = detaixuatkho::where([['id_xuatkho', $dt['id_xuatkho']],[ 'id_SP',$dt['id_SP']],['giaxuat',$dt['giaxuat']],['sl',$dt['sl']]])->first();
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
                $detail = detaixuatkho::where([['id_xuatkho', $dt['id_xuatkho']],
                [ 'id_SP',$dt['id_SP']],
                ['giaxuat',$dt['giaxuat']],
                ['sl',$dt['sl']]])
                ->update(['id_SP'=>$request['idSP'.$count],
                'giaxuat'=>$request['giaxuat'.$count],
                'sl'=>$request['sl'.$count]]);
        }
        
        return redirect()->back()->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\xuatKho  $xuatKho
     * @return \Illuminate\Http\Response
     */
    public function destroy(xuatKho $xuatKho)
    {
        //
    }

    /**
     * Update soluong product
     */

    public function updateProduct($idProduct, $soluong, $condition){
        $product = Product::find($idProduct);
        $sl = 0;
        if($condition == 'add'){
            $sl = $product['soluong'] + $soluong;
        }
        else{
            $sl = $product['soluong'] - $soluong;
        }
        Product::where('id', $idProduct)->update(['soluong' => $sl]);
    }

    /**
     * Xóa chi tiết sản phẩm trong xuatkho
     */
    public function removeDetailProduct(Request $request){
        $Nhap = xuatKho::find($request['id']);
        $Nhap['Tongtien'] = $request['tongtien'];
        $Nhap->save();
        $this->updateProduct($request['idSP'], $request['sl'],'add');
        $dt = detaixuatkho::where([['id_xuatkho', $request['id']],
        [ 'id_SP',$request['idSP']],
        ['sl',$request['sl']]])->delete();
        if($dt){
            return response()->json(['code' => 200]);
        }
    }

    /**
     * chi tiết sản phẩm trong xuatkho
     */
    public function listSpxuatKho(){
        $list['list'] = detaixuatkho::with(['product' => function($q){
            $q->with('supplier');
        }])->get();
        return view('Xuatkho.list', $list);
    }
}
