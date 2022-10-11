<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc;

final class Init
{
    //get alll service classes
    public static  function get_services()
    {
        return [
            Pages\AdminPages::class,
            Base\Enqueue::class,
            Base\CustomPostType::class,
            Base\SettingLinks::class,
        ];
    }
    //Register All Classes
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $services = self::instaniate($class);
            if (method_exists($services, 'register')) {
                $services->register();
            }
        }
    }
    //Initate Class
    public static function instaniate($calss)
    {
        $service = new $calss;
        return $service;
    }
}
