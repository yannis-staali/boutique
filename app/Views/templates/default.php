<?php

use Core\Auth\DBAuth;

$app = App::getInstance();
$auth = new DBAuth($app->getDb());

$isLogged = \App\Entity\UserEntity::isLogged();
$isAdmin = \App\Entity\UserEntity::isAdmin();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App::getInstance()->title; ?></title>
    <link rel="icon" type="image/png" href="../app/src/images/olegstore.jpg" />
    <!--Fonts -->
    
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <!---fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- Materialize icons -->
    

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!---own carousel --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- Materialize and CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/style1.css">
    <link rel="stylesheet" href="../public/css/style2.css">


    <!-- Js & Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.jss"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../public/js/script.js"></script>
    <script src="../public/js/main.js"></script>

</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<header>
    <!-- Dropdown Categories nav -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a class='teal-text' href='index.php?p=categories.index'>Voir les catégories</a></li>
        <li><a class='teal-text' href='index.php?p=products.index'>Tous les produits</a></li>
        <li class='divider'></li>
        <div class="row">
            <div class="col s6">
                <ul>
                    <h6>FEMME</h6>
                    <?php
                    foreach ($categories as $category) : ?>
                        <?php
                        if ($category->gender == 'Femme') : ?>
                            <li>
                                <a href='index.php?p=products.category&id=<?= $category->id ?>'><?= $category->nom ?></a>
                            </li>
                        <?php
                        endif ?>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
            <div class="col s6">
                <ul>
                    <h6>HOMME</h6>
                    <?php
                    foreach ($categories as $category) : ?>
                        <?php
                        if ($category->gender == 'Homme') : ?>
                            <li>
                                <a href='index.php?p=products.category&id=<?= $category->id ?>'><?= $category->nom ?></a>
                            </li>
                        <?php
                        endif; endforeach; ?>
                </ul>
            </div>
        </div>
    </ul>
    <!-- Dropdown Categories nav MOBILE-->
    <ul id="dropdown3" class="dropdown-content">
        <li><a href='index.php?p=categories.index'>Voir les catégories</a></li>
        <li><a href='index.php?p=products.index'>Tous les produits</a></li>
        <li class='divider'></li>
        <li>
            <ul>
                <li><em>Femme</em></li>
                <?php
                foreach ($categories as $category) : ?>
                    <?php
                    if ($category->gender == 'Femme') : ?>
                        <li>
                            <a href='index.php?p=products.category&id=<?= $category->id ?>'><?= $category->nom ?></a>
                        </li>
                    <?php
                    endif ?>
                <?php
                endforeach; ?>
            </ul>
        </li>
        <li>
            <ul>
                <li><em>Homme</em></li>
                <?php
                foreach ($categories as $category) : ?>
                    <?php
                    if ($category->gender == 'Homme') : ?>
                        <li>
                            <a href='index.php?p=products.category&id=<?= $category->id ?>'><?= $category->nom ?></a>
                        </li>
                    <?php
                    endif; endforeach; ?>
            </ul>
        </li>
    </ul>
    <!-- Dropdown Administrateur -->
    <ul id="dropdown2" class="dropdown-content">
        <li><a href="index.php?p=admin.categories.index">Catégories</a></li>
        <li><a href="index.php?p=admin.subcategories.index">Sous-catégories</a></li>
        <li><a href="index.php?p=admin.products.index">Produits</a></li>
    </ul>
    <!-- Dropdown Administrateur MOBILE -->
    <ul id="dropdown4" class="dropdown-content darken-3-text">
        <li><a href="index.php?p=admin.categories.index">Catégories</a></li>
        <li><a href="index.php?p=admin.subcategories.index">Sous-catégories</a></li>
        <li><a href="index.php?p=admin.products.index">Produits</a></li>
    </ul>
    <!-- nav -->
    <div class="navbar-fixed">
        <nav class="teal lighten-5">
            <div class="nav-wrapper container teal lighten-5">
                <a href="index.php" id="link_logo_header" class="brand-logo">OLEGSHOP.</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="text-darken-3">
                        <a class="navbar-brand text-darken-3 dropdown-trigger" href="#!" data-target="dropdown1">Catégories
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="navbar-brand dropdown-trigger darken-3-text <?= $isLogged && $isAdmin ? '' : 'd-none' ?>"
                           href="#!"
                           data-target="dropdown2">Espace administrateur
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=users.profil"
                           class="navbar-brand <?= $isLogged ? '' : 'd-none' ?> align-items-center">
                            Mon compte
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=users.panier"
                           class="navbar-brand align-items-center">
                            <i class="material-icons left">shopping_cart</i><span class="disappear1150">Panier</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=users.connexion"
                           class="navbar-brand <?= $isLogged ? 'd-none' : '' ?> align-items-center">
                            Se connecter
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=users.inscription"
                           class="navbar-brand <?= $isLogged ? 'd-none' : '' ?> align-items-center">
                            S'inscrire
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=users.disconnect"
                           class="navbar-brand <?= $isLogged ? '' : 'd-none' ?> align-items-center">
                            <i class="material-icons left">exit_to_app</i>
                            <span class="disappear1150">Se déconnecter</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- nav mobile -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="index.php" class="brand-logo center"><img class="logo_header2"
                                                               src=></a>
        </li>
        <li>
            <a class="navbar-brand dropdown-trigger" href="#!" data-target="dropdown3">Catégories<i
                        class="material-icons right">arrow_drop_down</i></a>
        <li class="<?= $isLogged && $isAdmin ? '' : 'd-none' ?>">
            <a class="navbar-brand dropdown-trigger" href="#!"
               data-target="dropdown4">Espace administrateur<i
                        class="material-icons right">arrow_drop_down</i></a>
        </li>
        <li class="<?= $isLogged ? '' : 'd-none' ?>">
            <a href="index.php?p=users.account"
               class="navbar-brand align-items-center">
                Mon compte
            </a>
        </li>
        <li class="">
            <a href="index.php?p=users.panier"
               class="navbar-brand align-items-center">
                Panier
                <i class="material-icons right">shopping_cart</i>
            </a>
        </li>
        <li class="<?= $isLogged ? 'd-none' : '' ?>">
            <a href="index.php?p=users.connexion"
               class="navbar-brand align-items-center">
                Se connecter
            </a>
        </li>
        <li class="<?= $isLogged ? 'd-none' : '' ?>">
            <a href="index.php?p=users.inscription"
               class="navbar-brand align-items-center">
                S'inscrire
            </a>
        </li>
        <li class="<?= $isLogged ? '' : 'd-none' ?>">
            <a href="index.php?p=users.disconnect"
               class="navbar-brand align-items-center">
                Se déconnecter
                <i class="material-icons right">exit_to_app</i>
            </a>
        </li>
    </ul>
</header>
<body>
<main role="main">

    <section class="container">
        <?= \Core\Alert\Alert::viewAlert(); ?>
        <?= $content; ?>
    </section>

</main>
</body>
<footer class="page-footer">
    <div class="container">
        <div class="row ">
            <div class="col l6 s12">
                <h5><a class="teal-text hover_footer" href="index.php">OLEG SHOP.</a></h5>
                <p class="teal-text">Boutique de vente de  vêtements et de produits dérivés</p>
            </div>

            

            

            <div class="col l4 offset-l2 s12">
                <h5 class="teal-text">Liens</h5>
                <ul>
                    <li><a class="teal-text hover_footer" href="index.php?p=categories.index">Categories</a></li>
                    <li><a class="teal-text hover_footer" href="index.php?p=users.panier">Panier</a></li>
                    <?php
                    if (isset($_SESSION['current_user'])) {
                        ?>
                        <li><a class="teal-text hover_footer" href="index.php?p=users.profil">Mon compte</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a class="teal-text hover_footer" href="index.php?p=users.inscription">Inscription</a></li>
                        <li><a class="teal-text hover_footer" href="index.php?p=users.connexion">Connexion</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container center ">
            <p class="black-text">© 2021  IBRAHIMA BAH ET YANNIS STAALI</p>
        </div>
    </div>
</footer>
</html>
