<?php

namespace App\Http\Controllers;
use App\product;
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
}
