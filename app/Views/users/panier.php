<h4 class="center">Votre panier</h4>
<form action="" method="POST" id="table_panier">
    <table class="highlight centered">
        <thead class="grey lighten-4">
        <tr>
            <th>Aperçu</th>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Prix total</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!$basket) {
            ?>
            <tr>
                <td colspan="6">Vous n'avez pas encore de produit dans votre panier</td>
            </tr>
            <?php
        } else {
            $total_price_basket = 0;
            foreach ($basket as $item) : ?>
                <tr>
                    <td>
                        <img class="image_admin" src="../app/src/images/<?= $item['image_path'] ?>"
                             alt="<?= $item['nom'] ?>">
                    </td>
                    <td><?= $item['nom'] ?></td>
                    <td><?= number_format($item['prix'], 2, ',', '') ?>€</td>
                    <td>
                        <button name="product_moins" value="<?= $item['id_produit'] ?>"
                                class="btn-floating btn-small waves-effect waves-light">
                            <i class="material-icons">expand_more</i>
                        </button>
                        <?= $item['quantite'] ?>
                        <button id="product_plus" name="product_plus" value="<?= $item['id_produit'] ?>"
                                class="btn-floating btn-small waves-effect waves-light <?= in_array(
                                    $item['id_produit'],
                                    $disable
                                ) ? 'disabled' : ''
                                ?>">
                            <i class="material-icons">expand_less</i>
                        </button>
                    </td>
                    <td>
                        <?= number_format(
                            ($item['total_panier']),
                            2,
                            ',',
                            ''
                        ) ?>€
                    </td>
                    <td>
                        <button name='suppress_item' value="<?= $item['id_produit'] ?>"
                                class="btn btn-small waves-effect waves-light red darken-3">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
                <?php
                $total_price_basket = $total_price_basket + $item['total_panier'];
            endforeach;
            ?>
            <tr>
                <td colspan="6">Total panier : <b><?= number_format(
                            $total_price_basket,
                            2,
                            ',',
                            ''
                        ) ?>€</b></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    if (!empty($basket)) {
        ?>
        <form method="post">
            <div class="center">
                <button value="valid_panier" name="valid_panier" class="btn btn-small waves-effect waves-light teal">
                    Valider
                </button>
            </div>
        </form>
        <?php
    }
    ?>
</form>
