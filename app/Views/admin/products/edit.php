<div class="p-1">
    <?php

    $gender = [];
    foreach ($categories as $category) {
        foreach ($subcategories as $subcategory) {
            if ($subcategory->id_categories === $category->id) {
                $gender += [$subcategory->id => $category->gender];
            }
        }
    }

    if (!empty($erreur)):?>
        <div class="alert alert-danger">
            <?= $erreur ?>
        </div>
    <?php
    endif ?>
    <?php
    if (isset($product)): ?>
        <div class="center">
            <img class="image_admin" alt="<?= $product->nom ?>" src="../app/src/images/<?= $product->image_path ?>">
        </div>
    <?php
    endif; ?>
    <div>
        <form class="col s12" method="post" enctype="multipart/form-data">
            <?= $form->input('image_path', 'Image du produit', ['type' => 'file']); ?>
            <?= $form->input('nom', 'Nom du produit'); ?>
            <?= $form->selectSendId('id_sous_categories', 'Sous-catégorie', $subcategories_name, $gender); ?>
            <?= $form->input('description', 'Description', ['type' => 'textarea']); ?>
            <?= $form->input('prix', '<i class="material-icons left">euro_symbol</i> Prix', ['type' => 'number']); ?>
            <?= $form->input('stock', 'Stock restant', ['type' => 'number']); ?>
            <div class="center">
                <button class="btn waves-effect waves-light">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>