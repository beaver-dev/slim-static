<?php
namespace Beaver\SlimStatic;

class Router extends SlimSugar
{
    public static function pathFor($name, array $data = [], array $queryParams = [])
    {
        return static::$slim->getContainer()['router']->pathFor($name, $data, $queryParams);
    }
}
