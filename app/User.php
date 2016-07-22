<?php

namespace sysvale;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Fenos\Notifynder\Notifable;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Notifable;
    protected $fillable = [
        'name', 'last_name', 'email', 'type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        //dd('full name');

        return $this->name . ' ' . $this->last_name;
    }

    public function vale()
    {

        return $this->hasOne('course\Vale');
    }


    public function detail()
    {

        return $this->hasOne('course\Detail');
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }


    public function user_departamentos()
    {

        return $this->belongsToMany('\sysvale\Departamento', 'user_empresa_departamento')
            ->withPivot('empresa_id', 'fecha');

    }

    public function user_empresas()
    {

        return $this->belongsToMany('sysvale\Empresa', 'user_empresa_departamento')
            ->withPivot('departamento_id', 'fecha');
    }

    public function vale_empresas()
    {

        return $this->belongsToMany('\sysvale\Empresa','empresa_departamento_users')
            ->withPivot('id', 'departamento_id', 'name_vale', 'date_vale', 'total_product', 'aprobacion_vale');
    }

    public function vale_departamentos()
    {

        return $this->belongsToMany('\sysvale\Departamento', 'empresa_departamento_users')
            ->withPivot('id', 'empresa_id', 'name_vale', 'date_vale', 'total_product', 'aprobacion_vale');
    }
    
   
}

