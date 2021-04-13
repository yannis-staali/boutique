<h4 class="center">Administrer les produits</h4>

<p class="center">
    <a href="?p=admin.products.add" class="btn btn-medium waves-effect waves-light green"><i
                class="left material-icons">add_circle</i>Ajouter un produit</a>
</p>

<table class="highlight">
    <thead>
    <tr>
        <td>#</td>
        <td>Catégorie</td>
        <td>Sous-catégorie</td>
        <td>Image</td>
        <td>Produit</td>
        <td><i class="material-icons">euro_symbol</i></td>
        <td>En stock</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($products as $product) :
        $i++; ?>
        <tr>
            <td><?= $i ?></td>
            <?php
            foreach ($subcategories as $subcategory) {
                if ($subcategory->id == $product->id_sous_categories) {
                    foreach ($categories as $category) {
                        if ($category->id == $subcategory->id_categories) { ?>
                            <td><?= $category->gender ?> / <?= $category->nom ?></td>
                            <td><?= $subcategory->nom ?></td>
                            <?php
                        }
                    }
                }
            } ?>
            <td><img class="image_admin" src="../app/src/images/<?= $product->image_path ?>"></td>
            <td class="center"><?= $product->nom ?></td>
            <td class="center"><?= $product->prix ?> €</td>
            <td class="center"><?= $product->stock ?></td>
            <td>
                <div class="center">
                    <a class="btn btn-small waves-effect waves-light teal"
                       href="?p=admin.products.edit&id=<?= $product->id ?>">Editer</a>
                    <form action="?p=admin.products.delete" method="post" style="display: inline">
                        <input type="hidden" name="id" value="<?= $product->id ?>">
                        <button type="submit" class="btn btn-small waves-effect waves-light red darken-3">
                            Supprimer
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>