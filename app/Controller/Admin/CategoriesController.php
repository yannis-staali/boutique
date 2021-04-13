<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use Core\img;

class CategoriesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
    }

    public function index()
    {
        $categories = $this->Category->all();
        $subcategories = $this->Subcategory->all();
        $this->render('admin.categories.index', compact('categories', 'subcategories'));
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
                    $name_file = explode('.', $img['name']);
                    $result = $this->Category->create(
                        [
                            'nom' => $_POST['nom'],
                            'gender' => $_POST['gender'],
                            'image_path' => $img['name'],
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
        $categories = $this->Category->all();
        $subcategories = $this->Subcategory->all();
        $form = new BootstrapForm($_POST);
        $this->render('admin.categories.edit', compact('form', 'erreur', 'categories', 'subcategories'));
    }

    public function edit()
    {
        $erreur = '';
        if (!empty($_FILES['image_path']['name'])) {
            $img = $_FILES['image_path'];
            $ext = strtolower(substr($img['name'], -3));
            $allow_ext = ['jpg', 'png', 'gif'];
            if (in_array($ext, $allow_ext)) {
                move_uploaded_file($img['tmp_name'], ROOT . '\app\src\images\\' . $img['name']);
                $name_file = explode('.', $img['name']);
                $result = $this->Category->update(
                    $_GET['id'],
                    [
                        'nom' => $_POST['nom'],
                        'gender' => $_POST['gender'],
                        'image_path' => $img['name'],
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
                $result = $this->Category->update(
                    $_GET['id'],
                    [
                        'nom' => $_POST['nom'],
                        'gender' => $_POST['gender']
                    ]
                );
                if ($result) {
                    return $this->index();
                }
            }
        }
        $category = $this->Category->find($_GET['id']);
        $categories = $this->Category->all();
        $form = new BootstrapForm($category);
        $this->render('admin.categories.edit', compact('form', 'category', 'categories', 'erreur'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Category->delete(
                $_POST['id']
            );
            return $this->index();
        }
    }

}
