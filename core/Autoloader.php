<?php

namespace Core;

/**
 * Class Autoloader
 * @package Tutoriel
 */
class Autoloader
{
    /**
     * Enregistre l'autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclus le fichier correspondant à notre class
     * @param $class string Le nom de la class à changer
     */
    static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }
}