<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socio extends Model
{
    use HasFactory;
    use Audit;
    use SoftDeletes;
    use QueryFilter;

    protected $table = 'socios';

    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'dni',
        //'direccion',
        //'fecha_nacimiento',
        //'ciudad',
        'codigo',
        'evento_id',
        'dni_promotor',
        'promotor_id',
        'zona_id',
        //'tyc',
        //'tyc_publicidad',
        'ingreso',
        'imagen_qr',
        'usuario_registra_id',
        'active',
        'tipo_ubicacion_id',
        'fecha_ingreso',
        'created_user_id','updated_user_id','deleted_user_id'
    ];


    public function tipoUbicacion(){
        return $this->hasOne(Tipos::class,'id','tipo_ubicacion_id');
    }

    public function promotor(){
        return $this->hasOne(Promotor::class,'id','promotor_id');
    }

    public function evento(){
        return $this->hasOne(Evento::class,'id','evento_id');
    }

}
