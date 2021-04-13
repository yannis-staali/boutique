<div class="m-0 row p-1">
    <div class="m-0 row p-1">
        <form method="post" action="index.php?p=products.search" class="col s12">
            <div class="m-0 row">
                <div class="input-field col s11 m5 offset-m6">
                    <input name="searchbox" type="text" id="autocomplete-input" class="autocomplete">
                    <label for="autocomplete-input">Rechercher l'article</label>
                </div>
                <div class="input-field col s1 m1">
                    <button class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">search</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row p-1">
        <div class="col s12">
        <span>
            <a class="disabled">
            <?= $product->getGender($subcategories, $categories); ?>
            </a>
            >
            <a href="index.php?p=products.category&id=<?= $product->getCategory($subcategories, $categories)[1] ?>">
                <?= $product->getCategory($subcategories, $categories)[0]; ?>
            </a>
            >
            <a href="index.php?p=products.subcategory&id=<?= $product->id_sous_categories ?>">
                <?= $product->sous_categorie ?>
            </a>
            >
            <a class="disabled"><?= $product->nom ?></a>
        </span>
        </div>
        <div class="col s6">
            <img class="image_show" src="../app/src/images/<?= $product->image_path ?>">
        </div>
        <div class="col s6">
            <h3><?= $product->nom; ?></h3>
            <span><?= $product->prix ?> €</span>
            <p><em><?= $product->sous_categorie ?></em></p>
            <div class="divider"></div>
            <p class="justify description">Description :
                <br>
                <?= $product->description ?>
            </p>
            <?php
            if ($product->stock == 0): ?>
                <button type="submit" class="btn" name="add_to_basket" disabled>Ajouter au panier</button>
                <p>Nous sommes désolé, il n'y a plus de stock pour ce produit :(</p>
            <?php
            else : ?>
                <form action="" method="POST">
                    <?= $form->input('quantity', 'Quantité', ['type' => 'number']); ?>
                    <button type="submit" class="btn" name="add_to_basket" value="1">Ajouter au panier</button>
                </form>
            <?php
            endif; ?>
        </div>
    </div>
</div>
