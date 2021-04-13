<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;

class ProductsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Product');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
    }

    public function index()
    {
        $products = $this->Product->all();
        $categories = $this->Category->all();
        $subcategories = $this->Subcategory->all();
        $this->render('admin.products.index', compact('products', 'categories', 'subcategories'));
    }

    public function add()
    {
        $erreur = '';
        if (!empty($_POST)) {
            if (!empty($_FILES['image_path'])) {
                $img = $_FILES['image_path'];
                $ext = strtolower(substr($img['name'], -3));
                $allow_ext = ['jpg', 'png', 'gif'];
                if (in_array($ext, $allow_ext)) {
                    move_uploaded_file($img['tmp_name'], ROOT . '\app\src\images\\' . $img['name']);
                    $result = $this->Product->create(
                        [
                            'nom' => $_POST['nom'],
                            'id_sous_categories' => $_POST['id_sous_categories'],
                            'description' => $_POST['description'],
                            'image_path' => $img['name'],
                            'prix' => $_POST['prix'],
                            'stock' => $_POST['stock']
                        ]
                    );
                    $_FILES['image_path'] = '';
                    if ($result) {
                        return $this->index();
                    }
                } else {
                    $erreur = "Votre fichier n'est pas une image";
                }
            }
        }
        $this->loadModel('Subcategory');
        $subcategories = $this->Subcategory->all();
        $subcategories_name = $this->Subcategory->extract('id', 'nom');
        $productsgender = $this->Category->extract('id', 'gender');
        $categories = $this->Category->all();
        $form = new BootstrapForm($_POST);
        $this->render(
            'admin.products.edit',
            compact('subcategories_name', 'subcategories', 'form', 'erreur', 'productsgender', 'categories')
        );
    }

    public
    function edit()
    {
        $erreur = '';
        if (!empty($_FILES['image_path']['name'])) {
            $img = $_FILES['image_path'];
            $ext = strtolower(substr($img['name'], -3));
            $allow_ext = ['jpg', 'png', 'gif'];
            if (in_array($ext, $allow_ext)) {
                move_uploaded_file($img['tmp_name'], ROOT . '\app\src\images\\' . $img['name']);
                $name_file = explode('.', $img['name']);
                $result = $this->Product->update(
                    $_GET['id'],
                    [
                        'nom' => $_POST['nom'],
                        'id_sous_categories' => $_POST['id_sous_categories'],
                        'description' => $_POST['description'],
                        'image_path' => $img['name'],
                        'prix' => $_POST['prix'],
                        'stock' => $_POST['stock']
                    ]
                );
                $_FILES['image_path'] = '';
                if ($result) {
                    return $this->index();
                }
            } else {
                $erreur = "Votre fichier n'est pas une image";
            }
        } else {
            if (!empty($_POST)) {
                $result = $this->Product->update(
                    $_GET['id'],
                    [
                        'nom' => $_POST['nom'],
                        'id_sous_categories' => $_POST['id_sous_categories'],
                        'description' => $_POST['description'],
                        'prix' => $_POST['prix'],
                        'stock' => $_POST['stock']
                    ]
                );
                if ($result) {
                    return $this->index();
                }
            }
        }

        $this->loadModel('Subcategory');
        $product = $this->Product->find($_GET['id']);
        $subcategories_name = $this->Subcategory->extract('id', 'nom');
        $subcategories = $this->Subcategory->all();
        $categories = $this->Category->all();
        $form = new BootstrapForm($product);
        $subcategoriesgender = $this->Category->extract('id', 'gender');
        $this->render(
            'admin.products.edit',
            compact(
                'subcategories_name',
                'form',
                'subcategoriesgender',
                'categories',
                'erreur',
                'product',
                'subcategories'
            )
        );
    }

    public
    function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Product->delete(
                $_POST['id']
            );
            return $this->index();
        }
    }

}
