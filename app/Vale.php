<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;

class Vale extends Model
{
    //

    public function detail(){

        return $this->belongsToMany('sysvale/EmpresaDepartamentoUser','details')
            ->withPivot('product_id');
    }



}
