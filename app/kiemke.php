<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kiemke extends Model
{
    protected $table = 'kiemke';

    public function product(){
        return $this->hasOne('App\product','id', 'id_sp');
    }
}
