<?php


namespace App\Controller;

use App\Entity\UserEntity;
use Core\Alert\Alert;
use Core\Controller\Controller;
use Core\HTML\BootstrapForm;
use Core\Session\Session;
use http\Client\Curl\User;

class UsersController extends AppController
{
    protected $errors = [];
    protected $success = [];

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
        $this->loadModel('Category');
        $this->loadModel('Product');
        $this->loadModel('Commande');
        $this->loadModel('ProductCommande');
    }

    public function commande()
    {
        $user = $this->User->find($_SESSION['current_user']['id']);
        $commande = $this->Commande->find($_GET['id']);
        if ($commande === false) {
            $this->notFound();
        }
        if ($commande->id_utilisateurs != $user->id){
            $this->forbidden();
        }
        $products = $this->ProductCommande->productsFromCommande($commande->numero);
        $categories = $this->Category->all();
        $this->render('users.commande', compact('products', 'categories','commande', 'user'));
    }

    public function disconnect()
    {
        session_destroy();
        unset($_SESSION['current_user']);
        $this->success[] = 'Vous êtes maintenant déconnecté';
        Alert::setAlert('success', $this->success);
        header('location:index.php?p=users.connexion');
    }

    public function inscription()
    {
        $categories = $this->Category->all();
        if (UserEntity::isLogged()) {
            header('location:index.php?p=users.profil');
        } else {
            if (!empty($_POST)) {
                //check mail disponibilité
                $email = $_POST['email'];
                if (!$this->User->isMailAvailable($email)) {
                    $this->errors[] = 'Cet email est déjà utilisé';
                }
                //check mail pattern
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->errors[] = "Le mail n'est pas valide";
                }
                //check password identiques
                if ($_POST['password'] != $_POST['password_confirm']) {
                    $this->errors[] = 'Les mots de passe ne sont pas identiques';
                }
                //check tous les inputs obligatoires
                if (isset($_POST['valid_insc']) && (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_confirm']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['ville']) || empty($_POST['cp']))) {
                    $this->errors[] = 'Veuillez remplir tous les champs obligatoires';
                }
                if (empty($this->errors)) {
                    $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $result = $this->User->create(
                        [
                            'email' => htmlspecialchars($_POST['email']),
                            'nom' => htmlspecialchars($_POST['nom']),
                            'prenom' => htmlspecialchars($_POST['prenom']),
                            'password' => $password_hash,
                            'adresse_facturation' => htmlspecialchars($_POST['adresse']),
                            'ville_facturation' => htmlspecialchars($_POST['ville']),
                            'code_postal_facturation' => htmlspecialchars($_POST['cp'])
                        ]
                    );
                    if ($result) {
                        $this->success[] = 'Votre compte a bien été créé, veuillez vous connecter';
                        Alert::setAlert('success', $this->success);
                        header('location:index.php?p=users.connexion');
                    }
                } else {
                    $messages = $this->errors;
                    Alert::setAlert('error', $messages);
                }
            }
        }
        $this->render('users.inscription', compact('categories'));
    }

    public function connexion()
    {
        $categories = $this->Category->all();
        $users = $this->User->all();
        if (UserEntity::isLogged()) {
            header('location:index.php?p=users.profil');
        } else {
            if (isset($_POST['valid_con'])) {
                if (empty($_POST['email']) || empty($_POST['password'])) {
                    $this->errors[] = 'Vous n\'avez pas rempli tous les champs';
                }
                $email = $_POST['email'];
                if (!$this->User->isRegistered($email)) {
                    $this->errors[] = 'Ces identifiants sont incorrects';
                } else {
                    $user = $this->User->isRegistered($email);
                    $password = $_POST['password'];
                    if (!password_verify($password, $user->password)) {
                        $this->errors[] = 'Ces identifiants sont incorrects';
                    }
                }
                if (empty($this->errors)) {
                    $user = [
                        'id' => $user->id,
                        'email' => $user->email,
                        'password' => $user->password,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'adresse_facturation' => $user->adresse_facturation,
                        'adresse_livraison' => $user->adresse_livraison,
                        'ville_facturation' => $user->ville_facturation,
                        'ville_livraison' => $user->ville_livraison,
                        'code_postal_facturation' => $user->code_postal_facturation,
                        'code_postal_livraison' => $user->code_postal_livraison,
                        'telephone' => $user->telephone,
                        'is_admin' => $user->is_admin
                    ];
                    $_SESSION['current_user'] = $user;
                    $this->success[] = 'Vous êtes maintenant connecté';
                    Alert::setAlert('success', $this->success);
                    if (isset($_SESSION['panier'])) {
                        header('location:index.php?p=users.panier');
                    } else {
                        header('location:index.php?p=users.profil');
                    }
                } else {
                    $messages = $this->errors;
                    Alert::setAlert('error', $messages);
                }
            }
            $this->render('users.connexion', compact('categories'));
        }
    }

    public function panier()
    {
        if (isset($_POST['valid_panier'])) {
            header('location:index.php?p=users.recapitulatifpanier');
        }
        $disable = [];
        $basket = $this->User->hasBasket();
        if (isset($_POST['suppress_item'])) {
            foreach ($basket as $key => $item) {
                if (isset($item['id_produit'])) {
                    if ($item['id_produit'] == $_POST['suppress_item']) {
                        unset($_SESSION['panier'][$key]);
                        $basket = $this->User->hasBasket();
                        $this->success[] = 'Le produit a été retiré du panier';
                        Alert::setAlert('success', $this->success);
                        break;
                    }
                }
            }
        }
        if (isset($_POST['product_moins'])) {
            foreach ($basket as $key => $item) {
                if (isset($item['id_produit'])) {
                    if ($item['id_produit'] == $_POST['product_moins']) {
                        $quantite = $item['quantite'];
                        if ($quantite > 1) {
                            $_SESSION['panier'][$key]['quantite'] = $_SESSION['panier'][$key]['quantite'] - 1;
                            $basket = $this->User->hasBasket();
                            $this->success[] = 'Le produit a été modifié';
                            Alert::setAlert('success', $this->success);
                            break;
                        }
                        if ($quantite <= 1) {
                            unset($_SESSION['panier'][$key]);
                            $basket = $this->User->hasBasket();
                            $this->success[] = 'Le produit a été retiré du panier';
                            Alert::setAlert('success', $this->success);
                            break;
                        }
                    }
                }
            }
        }

        if (isset($_POST['product_plus'])) {
            foreach ($basket as $key => $item) {
                if (isset($item['id_produit'])) {
                    if ($item['id_produit'] == $_POST['product_plus']) {
                        $quantite = $item['quantite'] + 1;
                        if (!$this->Product->isAvailableForThisQuantity($item['id_produit'], $quantite)) {
                            $this->errors[] = 'Il n\' y a plus de stock disponible pour ce produit';
                            Alert::setAlert('error', $this->errors);
                            break;
                        } else {
                            $_SESSION['panier'][$key]['quantite'] = $_SESSION['panier'][$key]['quantite'] + 1;
                            $basket = $this->User->hasBasket();
                            $this->success[] = 'Le produit a été modifié';
                            Alert::setAlert('success', $this->success);
                            break;
                        }
                    }
                }
            }
        }
        if ($this->User->hasBasket()) {
            $basket = $this->User->hasBasket();
            foreach ($basket as $key => $item) {
                $quantite = $item['quantite'] + 1;
                if (!$this->Product->isAvailableForThisQuantity($item['id_produit'], $quantite)) {
                    $disable[] = $item['id_produit'];
                }
            }
        }
        $categories = $this->Category->all();
        $this->render('users.panier', compact('categories', 'disable', 'basket'));
    }


    public function profil()
    {
        //pas de session current user
        if (!UserEntity::isLogged()) {
            header('location:index.php?p=users.connexion');
        } else {
            //session current user en cours
            $usersession = $_SESSION['current_user'];
            $user = $this->User->find($usersession['id']);
            //si envoi du form
            if (!empty($_POST['submit_profil'])) {
                //Traitement password
                //si un des 3 input password modifié
                if (!empty($_POST['now_password']) or !empty($_POST['new_password']) or !empty($_POST['password_confirm'])) {
                    //si les 3 inputs sont remplis
                    if (!empty($_POST['now_password']) and !empty($_POST['new_password']) and !empty($_POST['password_confirm'])) {
                        //si
                        if (password_verify($_POST['now_password'], $user->password)) {
                            if ($_POST['new_password'] != $_POST['password_confirm']) {
                                $this->errors[] = 'Les mots de passe ne sont pas identiques.';
                            } else {
                                $new_password_hashed = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                                $result = $this->User->update(
                                    $user->id,
                                    [
                                        'password' => $new_password_hashed
                                    ]
                                );
                                if ($result) {
                                    $_POST = '';
                                    $this->success[] = 'Votre mot de passe a bien été modifié.';
                                    Alert::setAlert('success', $this->success);
                                    return $this->profil();
                                }
                            }
                        } else {
                            if (!password_verify($_POST['now_password'], $user->password)) {
                                $this->errors[] = 'Votre mot de passe actuel est incorrect.';
                            }
                        }
                    } //si les 3 ne sont pas remplis
                    else {
                        $this->errors[] = 'Il faut remplir tous les champs de mot de passe.';
                    }
                }
                $result = $this->User->update(
                    $user->id,
                    [
                        'email' => htmlspecialchars($_POST['email']),
                        'prenom' => htmlspecialchars($_POST['prenom']),
                        'nom' => htmlspecialchars($_POST['nom']),
                        'adresse_facturation' => htmlspecialchars($_POST['adresse_facturation']),
                        'adresse_livraison' => htmlspecialchars($_POST['adresse_livraison']),
                        'ville_facturation' => htmlspecialchars($_POST['ville_facturation']),
                        'ville_livraison' => htmlspecialchars($_POST['ville_livraison']),
                        'code_postal_facturation' => (string)$_POST['code_postal_facturation'],
                        'code_postal_livraison' => (string)$_POST['code_postal_livraison'],
                        'telephone' => $_POST['telephone']
                    ]
                );
                if ($result) {
                    $this->success[] = 'Vos changements ont bien été effectués.';
                    Alert::setAlert('success', $this->success);
                    $_POST = '';
                    return $this->profil();
                }
            }
            $categories = $this->Category->all();
            $user_commandes = $this->Commande->findWithUser($user->id);
            $form = new BootstrapForm($user);
            if (!empty($this->errors)) {
                $messages = $this->errors;
                Alert::setAlert('error', $messages);
            }
            $this->render('users.profil', compact('user', 'form', 'user_commandes', 'categories'));
        }
    }

    public function confirmationcommande()
    {
        if (!UserEntity::isLogged()) {
            header('location:index.php?p=users.connexion');
        }
        if (!$this->User->hasBasket()) {
            header('location:index.php?p=users.panier');
        }
        else{
            $user = $this->User->current($_SESSION['current_user']['id']);
            $commande = $this->User->lastCommande($user->id);
            $produits = $this->ProductCommande->productsFromCommande($commande->numero);
            $categories = $this->Category->all();
            $this->render('users.confirmationcommande', compact('categories', 'commande', 'user', 'produits'));
            unset($_SESSION['panier']);
        }
    }

    public function paiement()
    {
        if (!UserEntity::isLogged()) {
            header('location:index.php?p=users.connexion');
        }
        if (!$this->User->hasBasket()) {
            header('location:index.php?p=users.panier');
        } else {
            $basket = $this->User->hasBasket();
        }
        $date_min = date('Y-m', strtotime('now'));
        $mois_min = date('m', strtotime('now'));
        if (isset($_POST['valid_pay'])) {
            if (empty($_POST['carte']) or empty($_POST['date_p']) or empty($_POST['crypto'])) {
                $this->errors[] = 'Veuillez remplir tous les champs';
            }
            if (!preg_match("#^[0-9]{4}[-/ ]?[0-9]{4}[-/ ]?[0-9]{4}[-/ ]?[0-9]{4}?$#", $_POST['carte'])) {
                $this->errors[] = 'Le format de la carte n\'est pas valide';
            }
            if (!preg_match("#^[2]{1}?[0-9]{3}?#", $_POST['date_p']) && ($_POST['date_p'] >= $date_min)) {
                $this->errors[] = 'La date est dépassée ou invalide';
            }
            if (!preg_match("#^[0-9]{3}?$#", $_POST['crypto'])) {
                $this->errors[] = 'Le cryptogramme n\'est pas valide';
            }
            $prix_commande = 0;
            foreach ($basket as $item) {
                if (!$this->Product->isAvailableForThisQuantity($item['id_produit'], $item['quantite'])) {
                    $this->errors[] = 'Il n\'y a plus de stock pour ce produit : ' . $item['nom'] . '<br>Veuillez modifier votre commande';
                }
                $prix_commande = $prix_commande + ($item['prix'] * $item['quantite']);
            }

            if (empty($this->errors)) {
                $n_commande = mt_rand();
                $user = $this->User->current($_SESSION['current_user']['id']);
                $this->Commande->create(
                    [
                        'numero' => $n_commande,
                        'prix_commande' => $prix_commande,
                        'adresse_livraison' => $user->adresse_livraison,
                        'ville_livraison' => $user->ville_livraison,
                        'code_postal_livraison' => $user->code_postal_livraison,
                        'id_utilisateurs' => $user->id
                    ]
                );
                foreach ($_SESSION['panier'] as $produit) {
                    $this->ProductCommande->create(
                        [
                            'id_produit' => $produit['id_produit'],
                            'quantite' => $produit['quantite'],
                            'num_commande' => $n_commande
                        ]
                    );
                    $product = $this->Product->find($produit['id_produit']);
                    $stock_product = $product->stock - $produit['quantite'];
                    $this->Product->update(
                        $produit['id_produit'],
                        [
                            'stock' => $stock_product
                        ]
                    );
                }


                $this->success[] = 'Votre commande est confirmée';
                Alert::setAlert('success', $this->success);
                header('location:index.php?p=users.confirmationcommande');
            } else {
                $messages = $this->errors;
                Alert::setAlert('error', $messages);
            }
        }

        $categories = $this->Category->all();
        $this->render('users.paiement', compact('categories', 'date_min', 'mois_min'));
    }

    public function recapitulatifadresse()
    {
        $logged_user = null;
        if (UserEntity::isLogged()) {
            $logged_user = $this->User->current($_SESSION['current_user']['id']);
        } else {
            header('location:index.php?p=users.connexion');
        }
        if (!$this->User->hasBasket()) {
            header('location:index.php?p=users.panier');
        }
        if (isset($_POST['precedant'])) {
            header('location:index.php?p=users.recapitulatifpanier');
        }
        if (isset($_POST['suivant'])) {
            if (isset($_POST['meme_adresse'])) {
                $user = $this->User->current($_SESSION['current_user']['id']);
                $result = $this->User->update(
                    $user->id,
                    [
                        'adresse_livraison' => $user->adresse_facturation,
                        'ville_livraison' => $user->ville_facturation,
                        'code_postal_livraison' => $user->code_postal_facturation
                    ]
                );
                if ($result) {
                    $this->success[] = 'Adresse de livraison enregistrée';
                    Alert::setAlert('success', $this->success);
                    header('location:index.php?p=users.paiement');
                }
            } else {
                if (!isset($_POST['adresse_livraison']) or !isset($_POST['ville_livraison']) or !isset($_POST['code_postal_livraison'])) {
                    $this->errors[] = 'Tous les champs de livraison doivent être remplis.';
                }
                if (empty($this->errors)) {
                    $user = $this->User->current($_SESSION['current_user']['id']);
                    $result = $this->User->update(
                        $user->id,
                        [
                            'adresse_livraison' => $_POST['adresse_livraison'],
                            'ville_livraison' => $_POST['ville_livraison'],
                            'code_postal_livraison' => $_POST['code_postal_livraison']
                        ]
                    );
                    if ($result) {
                        $this->success[] = 'Adresse de livraison modifiée';
                        Alert::setAlert('success', $this->success);
                        header('location:index.php?p=users.paiement');
                    }
                }
            }
        }
        if (!empty($this->errors)) {
            $messages = $this->errors;
            Alert::setAlert('error', $messages);
        }
        $form = new BootstrapForm($logged_user);
        $categories = $this->Category->all();
        $this->render('users.recapitulatifadresse', compact('categories', 'logged_user', 'form'));
    }

    public function recapitulatifpanier()
    {
        $basket = $this->User->hasBasket();
        if (!$basket) {
            header('location:index.php?p=users.panier');
        }
        if (isset($_POST['precedant'])) {
            header('location:index.php?p=users.panier');
        }
        if (isset($_POST['suivant'])) {
            header('location:index.php?p=users.recapitulatifadresse');
        }
        $categories = $this->Category->all();
        $this->render('users.recapitulatifpanier', compact('categories', 'basket'));
    }


}