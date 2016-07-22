<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;

class EmpresaDepartamentoUser extends Model
{
    //

    protected $fillable = [
        'name_vale','departamento_id','bloqueo'
    ];
    public function details_product(){

        return  $this->belongsToMany('\sysvale\Product','details')
            ->withPivot('empresa_departamento_user_id','cantidad','precio');

    }

    public function desbloquear(){

        $bloqueo= $this->bloqueo=0;
        $this->save();
    }

}
