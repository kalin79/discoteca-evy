<?php

namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use Audit;
    use SoftDeletes;
    use HasFactory;

    protected $table = 'eventos';
    protected $fillable = ['nombre', 'active','created_user_id','updated_user_id','deleted_user_id'];

    protected $dates = ['created_at','updated_at'];

    public function eventoPromotores(){
        return $this->hasMany(EventoPromotor::class,'evento_id');
    }

    public function getCantidadCodigoAttribute(){
        $cant = 0;
        foreach ($this->eventoPromotores as $eventoPromotore){
            $cant = $cant+ $eventoPromotore->sum('cantidad_codigos');
        }

        return $cant;
    }
}
