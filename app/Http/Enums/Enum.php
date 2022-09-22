<?php

namespace App\Http\Enums;

use ReflectionClass;

abstract class Enum {

    static public function all()
    {
        $class = new ReflectionClass(get_called_class());

        return array_keys($class->getConstants());
    }

    static public function has($constant)
    {
        $class = new ReflectionClass(get_called_class());

        return $class->getConstant($constant);
    }

    abstract static public function master();

}
