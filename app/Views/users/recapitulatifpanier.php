<section class="nav_etape m-1">
    <nav class="teal darken-1 round-corner height_auto_750">
        <div id="navbarNav round-corner">
            <ul class="etape navbar-nav row round-corner flex-row">
                <li class="nav-item col s3 p-0 active round-corner-left">
                    <a href="index.php?p=users.recapitulatifpanier" class="nav-link w-100 p-0 flex-around round-corner-left">
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
                <li class="nav-item col s3 p-0">
                    <a disabled class="nav-link w-100 p-0 flex-around round-corner-right" style="cursor: not-allowed">
                        4 - Confirmation
                        <span class="disappear1150"><i class="material-icons">check</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</section>
<h4>Récapitulatif du panier</h4>
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
    $total_price_basket = 0;
    foreach ($basket as $key => $item) {
        ?>
        <tr>
            <?php
            ?>
            <td><img src="../app/src/images/<?= $item['image_path'] ?>" alt="<?= $item['nom'] ?>" class="image_admin"></td>
            <td><?= $item['nom'] ?></td>
            <td><?= number_format($item['prix'], 2, ',', '') ?>€</td>
            <td><?= $item['quantite'] ?></td>
            <td><?= number_format(
                    ($item['total_panier']),
                    2,
                    ',',
                    ''
                ) ?>€
            </td>
        </tr>
        <?php
        $total_price_basket = $total_price_basket + $item['total_panier'];
    }
    ?>
    <tr>
        <td colspan="6" class="center">Grand total : <b><?= number_format(
                    $total_price_basket,
                    2,
                    ',',
                    ''
                ) ?>€</b></td>
    </tr>
    </tbody>
</table>
<section class="between">
    <form action="index.php?p=users.recapitulatifpanier" method="POST">
        <button name="precedant" class="btn btn-small waves-effect waves-light teal"><i class="material-icons left">chevron_left</i>Retour</button>
    </form>
    <form action="index.php?p=users.recapitulatifpanier" method="POST">
        <button name="suivant" class="btn btn-small waves-effect waves-light teal">Suite<i class="material-icons right">chevron_right</i></button>
    </form>
</section>


