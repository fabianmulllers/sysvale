<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable=['name_departamento'];

    public function empresas(){

        return $this->belongsToMany('sysvale\empresa');
    }

    public function user_empresas(){

        return $this->belongsToMany('\sysvale\Empresa','user_empresa_departamento')
            ->withPivot('user_id','fecha');

    }

    public function user_users(){

        return $this->belongsToMany('sysvale\User','user_empresa_departamento')
        ->withPivot('empresa_id','fecha');
    }

    public function vale_empresas(){

        return $this->belongsToMany('sysvale\Empresa','empresa_departamento_user')
            ->withPivot('departamento_id','name_vale','date_vale','total_product','aprobacion_vale');
    }
    public function vale_users(){

        return $this->belongsToMany('sysvale/User','empresa_departamento_user')
            ->withPivot('user_id','name_vale','date_vale','total_product','aprobacion_vale');
    }
}
