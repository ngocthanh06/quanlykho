<?php

namespace App\Http\Controllers;
use App\product;
use App\xuatKho;
use App\Nhapkho;
use App\detaixuatkho;
use App\chitietnhapkho;
use Illuminate\Http\Request;

class thongkeController extends Controller
{
    public function thongkesp(){
        return view('thongke.thongkesp');
    }

    public function postthongkesp(Request $request){
        $date = explode('-',$request->date);
        $year = $date[1];
        $month = $date[0];
        $thongke['thongke'] =  product::with(['category','supplier','chitietnhapkho' => function($q) use($month, $year){
                            $q->whereMonth('created_at', $month);
                            $q->whereYear('created_at', $year);
                        }
                        , 'detaixuatkho' => function($q) use($month, $year){
                            $q->whereMonth('created_at', $month);
                            $q->whereYear('created_at', $year);
                        }])->get();
        return view('thongke.thongkesp', $thongke);
    }
    public function home(){
        $now = date('Y-m-d');
        $soluongSP = $soluongXuat = $soluongNhap = $dangkd = $ngungkd = $dtNhap = $dtXuat = 0;
        $prod = product::all();
        $xuat = detaixuatkho::all();
        $nhap = chitietnhapkho::all();
        foreach($prod as $p){
            $soluongSP = $soluongSP + $p->soluong;
            $p->status == 1 ? $dangkd = $dangkd + 1 : $ngungkd = $ngungkd + 1; 
        }
        foreach($xuat as $p){
            $soluongXuat = $soluongXuat + $p->sl;
            $dtXuat = $dtXuat + ($p->sl * $p->giaxuat);

        }
        foreach($nhap as $p){
            $soluongNhap = $soluongNhap + $p->sl;
            $dtNhap = $dtNhap + ($p->sl * $p->gianhap);
        }
        $saphh = product::where('ngayhh', '<', $now)->count();
        $listxuat = detaixuatkho::with('product')->paginate(10);
        $listnhap = chitietnhapkho::with('product')->paginate(10);
        $listClient = xuatKho::with('client', 'detaixuatkho')->paginate(10);
        $data = array(
            'slSP' => $soluongSP,
            'slXuat' => $soluongXuat,
            'slNhap' => $soluongNhap,
            'dangkd' => $dangkd,
            'ngungkd' => $ngungkd,
            'dtNhap' => $dtNhap,
            'dtXuat' => $dtXuat,
            'saphh' => $saphh,
            'xuat' => $listxuat,
            'nhap' => $listnhap,
            'client' => $listClient
        );
        
        // return $data;

        return view('thongke.kiemke', $data);
    }
}
