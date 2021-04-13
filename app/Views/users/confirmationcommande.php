<section class="nav_etape m-1">
    <nav class="teal darken-1 round-corner height_auto_750">
        <div id="navbarNav round-corner">
            <ul class="etape navbar-nav row round-corner flex-row">
                <li class="nav-item col s3 p-0">
                    <a href="index.php?p=users.recapitulatifpanier"
                       class="nav-link w-100 p-0 flex-around round-corner-left">
                        1 - Vérification du Panier
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0">
                    <a href="index.php?p=users.recapitulatifadresse" class="nav-link w-100 p-0 flex-around">
                        2 - Adresse livraison
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0">
                    <a disabled class="nav-link w-100 p-0 flex-around" style="cursor: not-allowed">
                        3 - Paiement
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item active col s3 p-0 round-corner-right">
                    <a disabled class="nav-link w-100 p-0 flex-around round-corner-right" style="cursor: not-allowed">
                        4 - Confirmation
                        <span class="disappear1150"><i class="material-icons">check</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</section>
<h4 class="center">Confirmation de la commande n°<?= $commande->numero ?></h4>
<section>
    <article class="alert-info">
        En raion du Covid-19, nous avons pris du retard sur nos livraisons.
        <br>
        Merci de votre compréhension
    </article>
    <div class="adresse_liv" class="grey lighten-5">
        <h5 class="center">Adresse de livraison</h5>
        <ul class="adresse center">
            <li><?= ucfirst($user->prenom). ' ' . strtoupper($user->nom) ?></li>
            <li><?= $commande->adresse_livraison ?></li>
            <li><?= $commande->code_postal_livraison ?> <?= $commande->ville_livraison ?></li>
            <li>France</li>
        </ul>
    </div>
</section>
<table class="table_verification">
    <thead class="grey lighten-4">
    <tr>
        <th colspan="2">Produit</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Prix total</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($produits as $produit) {
        ?>
        <tr>
            <td><img class="image_admin" src="../app/src/images/<?= $produit->image_path ?>" alt="<?= $produit->nom ?>" class="img_panier"></td>
            <td><?= $produit->nom ?></td>
            <td><?= number_format($produit->prix, 2, ',', '') ?>€</td>
            <td><?= $produit->quantite ?></td>
            <td><?= $prixtotal = number_format(($produit->prix * $produit->quantite), 2, ',', '') ?>€</td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td colspan="5" class="center">Prix de la commande : <b><?= $commande->prix_commande ?>€</b></td>
    </tr>
    </tbody>
</table>
<div class="center">
    <form class="custom_form" action="index.php?p=products.index" method="POST">
        <input type="submit" name="valid_panier" value="Retour Shop" class="btn bouton m-4 custom">
    </form>
</div>

<style>
.custom_form {
    display: flex;
    justify-content:center;
    align-items:center; 
}
.custom {
    width: 200px;
}
</style>

