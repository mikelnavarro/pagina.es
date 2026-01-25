<?php
// core/Config.php
namespace Mikelnavarro\TiendaAplicacion\core;
class Config
{
    private static $config;

    public static function get($section, $key)
    {
        if (self::$config === null) {
            self::$config = parse_ini_file(__DIR__ . '/../config/config.ini', true);
        }
        return self::$config[$section][$key] ?? null;
    }
}