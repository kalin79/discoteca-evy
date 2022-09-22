<?php


namespace App\Http\Enums;


class TypeUbicacion extends Enum
{
    const TERRAZA    = 1;
    const DISCOTECA     = 2;
    protected static $masterId = 1;

    public static function master()
    {
        return self::$masterId;
    }
}
