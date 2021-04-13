<?php

namespace App\Entity;

use Core\Entity\Entity;

class CommandeEntity extends Entity{

    public function getUrl(){
        return 'index.php?p=users.commande&id=' . $this->id;
    }

}