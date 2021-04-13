<?php

namespace App\Controller\Admin;

use \App;
use \Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController
{

    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();

        if (!App\Entity\UserEntity::isAdmin()) {
            $this->forbidden();
        }
    }

}