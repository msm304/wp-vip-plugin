<?php

class AutoLoad
{
    private static $_instance = null;

    private function __construct()
    {
        spl_autoload_register([$this, 'load']);
    }

    public static function _instance()
    {
        if (!self::$_instance) {
            self::$_instance = new AutoLoad();
        }
        return self::$_instance;
    }

    public function load($class)
    {
//        echo '<pre>';
//        var_dump($class);
//        echo '</pre>';
        if (is_readable(trailingslashit(VIP_PLUGIN_DIR . 'class') . $class . '.php')) {
            if (file_exists(trailingslashit(VIP_PLUGIN_DIR . 'class') . $class . '.php')) {
                include_once trailingslashit(VIP_PLUGIN_DIR . 'class') . $class . '.php';
            }
        }
        return;
    }
}

AutoLoad::_instance();