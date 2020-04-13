<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietnhapkho extends Model
{
    protected $table = 'chitietnhapkho';
    protected $primaryKey = 'id_nhapkho';
    public function product(){
        return $this->belongsTo('App\product','id_SP','id');
    }
}
