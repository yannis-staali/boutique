<?php

namespace App\Entity;

use Core\Entity\Entity;

class SubcategoryEntity extends Entity{

    public function getUrl(){
        return 'index.php?p=products.subcategory&id=' .$this->id;
    }

}