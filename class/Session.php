<?php

class Session
{
    public static function isSetSession($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (self::isSetSession($key)) {
            return $_SESSION[$key];
        }
    }

    public static function unset($key)
    {
        if(self::isSetSession($key)){
            unset($_SESSION[$key]);
        }
    }
}
