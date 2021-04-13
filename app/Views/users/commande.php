<section class="m-1">
    <h4>Votre commande n°<?= $commande->numero ?></h4>
    <p>Commandée le <?= date("d/m/y", strtotime($commande->date_commande)) ?> à <?= date(
            "H:i",
            strtotime(
                $commande->date_commande
            )
        ) ?></p>
    <br>
    <article>
        <h5 class="center">Adresse de livraison</h5>
        <ul class="adresse center">
            <li><?= ucfirst($user->prenom). ' ' . strtoupper($user->nom) ?></li>
            <li><?= $commande->adresse_livraison ?></li>
            <li><?= $commande->code_postal_livraison ?> <?= $commande->ville_livraison ?></li>
            <li>France</li>
        </ul>
    </article>
    <br>
    <article>
        <h5 class="center">Détail de la facture</h5>
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
            foreach ($products as $produit) : ?>
                <tr>
                    <td><img class="image_admin" src="../app/src/images/<?= $produit->image_path ?>"
                             alt="<?= $produit->nom ?>"
                             class="img_panier"></td>
                    <td><?= $produit->nom ?></td>
                    <td><?= number_format($produit->prix, 2, ',', '') ?>€</td>
                    <td><?= $produit->quantite ?></td>
                    <td><?= $prixtotal = number_format(($produit->prix * $produit->quantite), 2, ',', '') ?>€</td>
                </tr>
            <?php
            endforeach;
            ?>
            <tr>
                <td colspan="5" class="center">Prix de la commande : <b><?= $commande->prix_commande ?>€</b></td>
            </tr>
            </tbody>
        </table>
    </article>
</section>