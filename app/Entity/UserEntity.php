<?php

namespace App\Entity;

use Core\Entity\Entity;

class UserEntity extends Entity
{

    static function isLogged()
    {
        return (isset($_SESSION['current_user']));
    }
    static function isAdmin()
    {
        if (isset($_SESSION['current_user'])){
            if ($_SESSION['current_user']['is_admin'] == 1){
                return true;
            }
        }
        return false;
    }
}
