<?php
namespace Beaver\SlimStatic;

class Router extends SlimSugar
{
    public static function pathFor()
    {
        return call_user_func_array(array(static::$slim, 'pathFor'), func_get_args());
    }
}
