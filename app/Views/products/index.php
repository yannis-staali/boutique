<div class="row p-1">
    <div class="m-0 row p-1">
        <form method="post" action="index.php?p=products.search" class="col s12">
            <div class="m-0 row">
                <div class="input-field col s11 m5 offset-m6">
                    <input name="searchbox" type="text" id="autocomplete-input" class="autocomplete">
                    <label for="autocomplete-input">Rechercher l'article</label>
                </div>
                <div class="input-field col s1 m1">
                    <button class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">search</i></button>
                </div>
            </div>
        </form>
    </div>
    <a id="button_see_categories" class="disappear600 btn waves-effect waves-light m-1"><i class="material-icons left">arrow_downward</i>Voir les catégories<i class="material-icons right">arrow_downward</i></a>
    <h4 class="m-0 center">Tous les produits</h4>
    <div class="col s12 m9">
        <div class="row">
            <?php
            foreach ($products as $product): ?>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <a class="link_card_hover" href="<?= $product->url ?>">
                                <img src="../app/src/images/<?= $product->image_path ?>" alt="<?= $product->nom ?>">
                                <span class="card-title card_hover"><?= $product->nom ?></span>
                                <button class="btn-floating btn-large halfway-fab"><?= $product->prix ?> €</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>

    <div id="categories" class="col s12 m3">
        <ul class="collection with-header">
            <li class="collection-header center">Femme</li>
            <?php
            foreach ($categories as $category2) {
                if ($category2->gender == 'Femme') { ?>
                    <li class="collection-header">
                        <a href=" <?= $category2->url; ?>">
                            <h6><?= $category2->nom ?></h6>
                        </a>
                    </li>
                    <?php
                    foreach ($subcategories as $subcategory) {
                        if ($subcategory->id_categories == $category2->id) { ?>
                            <li class="collection-item">
                                <a href="<?= $subcategory->url; ?>"><?= $subcategory->nom ?></a>
                            </li>
                            <?php
                        }
                    } ?>
                    <?php
                } ?>
                <?php
            } ?>
            <li class="collection-header center">Homme</li>
            <?php
            foreach (
                $categories
                as $category2
            ) {
                if ($category2->gender == 'Homme') { ?>
                    <li class="collection-header">
                        <a href=" <?= $category2->url; ?>">
                            <h6><?= $category2->nom ?></h6>
                        </a>
                    </li>
                    <?php
                    foreach ($subcategories as $subcategory) {
                        if ($subcategory->id_categories == $category2->id) { ?>
                            <li class="collection-item">
                                <a href="<?= $subcategory->url; ?>"><?= $subcategory->nom ?></a>
                            </li>
                            <?php
                        }
                    }
                }
            } ?>
        </ul>
    </div>
</div>