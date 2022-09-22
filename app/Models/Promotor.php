<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotor extends Model
{
    use HasFactory;
    use Audit;
    use SoftDeletes;
    use QueryFilter;

    protected $table = 'promotores';

    protected $fillable = [
        'nombre',
        'email',
        'edad',
        'sexo','dni',
        'created_user_id','updated_user_id','deleted_user_id'
    ];
}
