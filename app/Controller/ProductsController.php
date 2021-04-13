<?php

namespace App\Controller;

use Core\Alert\Alert;
use Core\Controller\Controller;
use Core\HTML\BootstrapForm;

class ProductsController extends AppController
{

    private $errors = [];
    private $success = [];

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Product');
        $this->loadModel('Subcategory');
        $this->loadModel('Category');
    }

    public function index()
    {
        $products = $this->Product->last();
        $subcategories = $this->Subcategory->all();
        $categories = $this->Category->all();
        $this->render('products.index', compact('products', 'subcategories', 'categories'));
    }

    public function subcategory()
    {
        $subcategory = $this->Subcategory->find($_GET['id']);
        if ($subcategory === false) {
            $this->notFound();
        }
        $products = $this->Product->lastBySubcategory($_GET['id']);
        $subcategories = $this->Subcategory->all();
        $categories = $this->Category->all();
        $this->render('products.subcategory', compact('products', 'subcategories', 'subcategory', 'categories'));
    }

    public function category()
    {
        $category = $this->Category->find($_GET['id']);
        if ($category === false) {
            $this->notFound();
        }
        $products = $this->Product->lastByCategory($_GET['id']);
        $categories = $this->Category->all();
        $subcategories = $this->Subcategory->all();
        $this->render('products.category', compact('products', 'categories', 'category', 'subcategories'));
    }

    public function search(){
        $products = $this->Product->all();
        if(isset($_POST['searchbox'])){
            $recherche = $_POST['searchbox'];
            $match_products = [];
            foreach ($products as $product) {
                if (preg_match("/$recherche/i", $product->nom)){
                    $match_products[] = $product;
                }
            }
            $products = $match_products;
        }
        else{
            $products = $this->Product->all();
        }
        $subcategories = $this->Subcategory->all();
        $categories = $this->Category->all();
        $this->render('products.search', compact('products', 'categories', 'subcategories'));
    }

    public function show()
    {
        $product = $this->Product->findWithSubcategory($_GET['id']);
        if (isset($_POST['add_to_basket'])) {
            $total_quantity = $_POST['quantity'];
            //vérification si le produit existe déjà dans le panier
            if (isset($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $key => $value) {
                    if (isset($_SESSION['panier'][$key]['id_produit'])) {
                        if ($_SESSION['panier'][$key]['id_produit'] == $product->id) {
                            $total_quantity = $_SESSION['panier'][$key]['quantite'] + $_POST['quantity'];
                            break;
                        }
                    }
                }
            }
            if (!$this->Product->isAvailableForThisQuantity($product->id, $total_quantity)) {
                $this->errors[] = 'Il n\'y a plus de stock pour le produit et la quantité demandée';
            }
            if (!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)) {
                $this->errors[] = 'Cette action est impossible';
            }
            if (empty($this->errors)) {
                $product_already_in_basket = false;
                if (isset($_SESSION['panier'])) {
                    foreach ($_SESSION['panier'] as $key => $value) {
                        if (isset($_SESSION['panier'][$key]['id_produit'])) {
                            if ($_SESSION['panier'][$key]['id_produit'] == $product->id) {
                                $_SESSION['panier'][$key] = [
                                    'id_produit' => $product->id,
                                    'quantite' => $total_quantity,
                                    'prix' => $product->prix,
                                    'image_path' => $product->image_path,
                                    'nom' => $product->nom,
                                    'total_panier' => $total_quantity * $product->prix
                                ];
                                $product_already_in_basket = true;
                                $this->success[] = 'Le produit a bien été ajouté au panier';
                                Alert::setAlert('success', $this->success);
                                break;
                            }
                        }
                    }
                }
                if (!$product_already_in_basket) {
                    $_SESSION['panier'][] = [
                        'id_produit' => $product->id,
                        'quantite' => $total_quantity,
                        'prix' => $product->prix,
                        'image_path' => $product->image_path,
                        'nom' => $product->nom,
                        'total_panier' => $total_quantity * $product->prix
                    ];
                    $this->success[] = 'Le produit a bien été ajouté au panier';
                    Alert::setAlert('success', $this->success);
                }
            } else {
                $messages = $this->errors;
                Alert::setAlert('error', $messages);
            }
        }
        $form = new BootstrapForm($_POST);
        $categories = $this->Category->all();
        $subcategories = $this->Subcategory->all();
        $this->render('products.show', compact('product', 'categories', 'subcategories', 'form'));
    }

    public function home()
    {
        $derniers = $this->Product->dernier();
        $meilleurs = $this->Product->meilleur();

        $categories = $this->Category->all();
        $this->render(
            'products.home',
            compact(
                'categories',
                'derniers',
                'meilleurs'
            )
        );
    }
}