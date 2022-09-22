<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodigosCliente extends Model
{
    use HasFactory;
    use Audit;
    use SoftDeletes;
    use QueryFilter;

    protected $table = 'codigos_cliente';

    protected $fillable = [
        'evento_promotor_id',
        'codigo',
        'created_user_id','updated_user_id','deleted_user_id'
    ];

    public function eventoProveedor(){
        return $this->belongsTo(EventoPromotor::class,'evento_promotor_id','id');
    }
}
