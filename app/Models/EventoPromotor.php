<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoPromotor extends Model
{
    use Audit;
    use SoftDeletes;
    use HasFactory;
    use QueryFilter;
    protected $table = 'evento_promotores';
    protected $fillable = ['evento_id','promotor_id','zona_id','cantidad_codigos', 'active','created_user_id','updated_user_id','deleted_user_id'];

    protected $dates = ['created_at','updated_at'];

    public function promotor(){
        return $this->hasOne(Promotor::class,'id','promotor_id');
    }

    public function zona(){
        return $this->hasOne(Zona::class,'id','zona_id');
    }

    public function evento(){
        return $this->belongsTo(Evento::class,'evento_id','id');
    }

    public function codigos(){
        return $this->hasMany(CodigosCliente::class,'evento_promotor_id');
    }

    public function getCantidadCodigosRegistradosAttribute(){
        return Cliente::where('evento_id',$this->evento_id)->where('zona_id',$this->zona_id)->where('promotor_id',$this->promotor_id)->count();
    }
    public function getCantidadCodigosIngresoAttribute(){
        return Cliente::where('evento_id',$this->evento_id)->where('zona_id',$this->zona_id)->where('promotor_id',$this->promotor_id)->where('ingreso',1)->count();
    }
}
