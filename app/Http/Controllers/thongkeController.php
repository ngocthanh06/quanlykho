<?php

namespace App\Http\Controllers;
use App\product;
use App\xuatKho;
use App\Nhapkho;
use App\kiemke;
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
                        }
                        ])->get();
        $thongke['month'] = $month;
        return view('thongke.thongkesp', $thongke);
    }

    public function addThucte($id){
        $prod['product'] = product::find($id);
        return view('thongke.addThucte', $prod);
    }

    public function postaddThucte(Request $request, $id){
        $prod = new kiemke();
        $prod['id_sp'] = $id;
        $prod['soluong'] = $request->soluong;
        $prod['noidung'] = $request->noidung;
        $prod->save();
        return redirect()->intended('/kiemke')->with('success','Thêm thành công'); 
    }
    
    public function kiemke(){
        $prod['product'] = product::with('category', 'supplier','kiemke')->get();
        $prod['month'] = date('m');
        return view('thongke.kiemtra', $prod);
    }

    public function thongketonkho(){
        $prod['product'] = product::with('category', 'supplier')->where('soluong','>', 0)->get();
        return view('thongke.thongketonkho', $prod);
    }


    public function editThucte($id){
        $prod['kiemke'] = kiemke::with('product')->where('id_sp',$id)->first();
        return view('thongke.editThucte', $prod);
    }

    public function searchKiemke(Request $request){
        $date = explode('-',$request->date);
        $year = $date[1];
        $month = $date[0];
        $prod['product'] = product::with(['category', 'supplier','kiemke'=>function($q) use ($year, $month){
            $q->whereMonth('created_at', $month);
            $q->whereYear('created_at', $year);
        }])->get();
        $prod['month'] = $month;
        return view('thongke.kiemtra', $prod);
    }

    public function postEditThucte(Request $request, $id){
        $prods = kiemke::where('id_sp',$id)->first();
        $prod = kiemke::find($prods->id);
        $prod['soluong'] = $request->soluong;
        $prod['noidung'] = $request->noidung;
        $prod->update();
        return redirect()->intended('/kiemke')->with('success','Sửa thành công'); 
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
