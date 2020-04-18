<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class xuatKho extends Model
{
    protected $table = 'xuat_khos';
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function client(){
        return $this->belongsTo('App\Client','client_id','id');
    }
    public function detaixuatkho(){
        return $this->hasMany('App\detaixuatkho','id_xuatkho', 'id');
    }
    
}
