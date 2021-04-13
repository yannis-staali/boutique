<?php

namespace App\Controller;

use Core\Controller\Controller;

class SubcategoriesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Product');
        $this->loadModel('Subcategory');
        $this->loadModel('Category');
    }

}