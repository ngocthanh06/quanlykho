<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detaixuatkho extends Model
{
    protected $table = 'detailxuatkhos';
    protected $primaryKey = 'id_xuatkho';
    protected $guarded = [];
    protected $fillable = ['id_xuatkho','id_SP','sl','giaxuat'];
    public function product(){
        return $this->belongsTo('App\product','id_SP','id');
    }
}
