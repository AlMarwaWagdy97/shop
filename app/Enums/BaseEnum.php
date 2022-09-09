<?php


namespace App\Enums;


use Illuminate\Support\Str;
use ReflectionClass;

class BaseEnum
{
    public static function all(): array
    {
        try {
            $self = new ReflectionClass(get_called_class());
            return array_values($self->getConstants());
        } catch (\ReflectionException $e) {
            return [];
        }
    }

    public static function findByValue($val): string
    {
        try {
            $self = new ReflectionClass(get_called_class());
            foreach ($self->getConstants() as $key => $value)
                if ($val == $value)
                    return str_replace('_' , ' ', Str::title($key) );
            return $val;
        } catch (\ReflectionException $e) {
            return $val;

        }
    }
}
