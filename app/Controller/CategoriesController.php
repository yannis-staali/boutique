<?php

namespace App\Controller;

use Core\Controller\Controller;

class CategoriesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index(){
        $categories = $this->Category->all();
        $this->render('categories.index', compact( 'categories'));
    }

}