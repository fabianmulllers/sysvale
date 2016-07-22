<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name_product','precio_product','stock_product'
    ];


    public function details_vale(){

       return  $this->belongsToMany('\sysvale\EmpresaDepartamentoUser','details')
           ->withPivot('vale_id');

    }

}

