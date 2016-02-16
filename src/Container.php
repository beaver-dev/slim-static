<?php
namespace Beaver\SlimStatic;

class Container extends SlimSugar
{
    public static function get($key)
	{
		return static::$slim->getContainer()[$key];
	}

	public static function set($key, $value)
	{
		return static::$slim->getContainer()[$key] = $value;
	}
}
