<?php

namespace config;

class Config
{
    private static $settings = [];

    public static function get($key) {
        if (isset(self::$settings[$key])) {
            self::$settings = parse_ini_file(__DIR__ . '/config.ini', true);
        }
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
}