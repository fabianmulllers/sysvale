<?php

namespace sysvale;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    protected $fillable = [
        'name_empresa','rut_empresa', 'direccion','name_departamento'
    ];
    //

   public function departamentos(){

      return $this->belongsToMany('sysvale\Departamento');
    }

    public function user_departamentos(){

        return $this->belongsToMany('\sysvale\Departamento','user_empresa_departamento')
            ->withPivot('user_id','fecha');

    }

    public function user_users(){

        return $this->belongsToMany('sysvale\User','user_empresa_departamento')
            ->withPivot('empresa_id','fecha');
    }

    public function vale_users(){

        return $this->belongsToMany('sysvale\User','empresa_departamento_users')
            ->withPivot('id','user_id','name_vale','date_vale','total_product','aprobacion_vale');
    }
    public function vale_departamentos(){

        return $this->belongsToMany('sysvale\Departamento','empresa_departamento_users')
            ->withPivot('id','empresa_id','name_vale','user_id','date_vale','total_product','aprobacion_vale')
            ->join('users', 'users.id', '=', 'user_id')
            ->select('departamentos.*','users.name','users.last_name');
    }
}
