<?php
/*
use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if (isset($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 'home';
}

//Auth

$app = App::getInstance();

$auth = new DBAuth($app->getDb());
if (!$auth->logged()){
    $app->forbidden();
}

ob_start();

if ($page === 'home'){
    require ROOT . '/pages/admin/products/index.php';
}elseif ($page === 'products.edit'){
    require ROOT . '/pages/admin/products/edit.php';
}elseif ($page === 'products.add'){
    require ROOT . '/pages/admin/products/add.php';
}elseif ($page === 'products.delete'){
    require ROOT . '/pages/admin/products/delete.php';
}elseif ($page === 'subcategories.index'){
    require ROOT . '/pages/admin/subcategories/index.php';
}elseif ($page === 'subcategories.edit'){
    require ROOT . '/pages/admin/subcategories/edit.php';
}elseif ($page === 'subcategories.add'){
    require ROOT . '/pages/admin/subcategories/add.php';
}elseif ($page === 'subcategories.delete'){
    require ROOT . '/pages/admin/subcategories/delete.php';
}

$content = ob_get_clean();
require ROOT . '/pages/templates/default.php';
*/
