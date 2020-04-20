<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    public function category(){{
        return $this->hasOne('App\category','id','id_category');
    }}

    public function supplier(){
        return $this->hasOne('App\supplier', 'id', 'id_supplier');
    }

    public function chitietnhapkho(){
        return $this->hasMany('App\chitietnhapkho', 'id_SP','id');
    }

    public function detaixuatkho(){
        return $this->hasMany('App\detaixuatkho', 'id_SP', 'id');
    }
}
