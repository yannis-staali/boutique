<?php

namespace Core\Session;

class Session
{
    static $instance;
    static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Session();
        }
        return self::$instance;
    }
    public function __construct()
    {
        session_start();
    }
    public function setFlash($cle, $message)
    {
        $_SESSION['flash'][$cle] = $message;
    }
    public function setSession($cle, $valeur)
    {
        $_SESSION["$cle"] = $valeur;
    }
    public function addSession($cle, $champ, $valeur)
    {
        $_SESSION["$cle"][$champ] = $valeur;
    }
    public function hasFlashes()
    {
        return isset($_SESSION['flash']);
    }
    public function getFlashes()
    {
        $flash =  $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    public function hasSession($cle)
    {
        if(isset($_SESSION[$cle]))
        {
            return $_SESSION[$cle];
        }

    }
}