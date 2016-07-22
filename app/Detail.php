<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    //
    protected $fillable = [
        'name_product','cantidad', 'precio'
    ];
}
