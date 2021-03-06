<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhapkho extends Model
{
    protected $table = 'nhapkho';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

   

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function chitietnhapkho(){
        return $this->hasMany('App\chitietnhapkho','id_nhapkho', 'id');
    }
    public function nhasanxuat(){
        return $this->hasOne('App\nhasanxuat', 'id', 'id_nhasx');
    }
}
