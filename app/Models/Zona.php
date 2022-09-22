<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
{
    use HasFactory;
    use Audit;
    use SoftDeletes;
    use QueryFilter;

    protected $table = 'zonas';

    protected $fillable = [
        'nombre',
        'cantidad_codigos',
        'created_user_id','updated_user_id','deleted_user_id'
    ];
}
