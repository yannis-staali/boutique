<div class="p-1">
    <?php

    if (!empty($erreur)):?>
        <div class="alert alert-danger">
            <?= $erreur ?>
        </div>
    <?php
    endif ?>
    <?php
    if (isset($category)): ?>
        <div class="center">
            <img alt="<?= $category->nom ?>" src="../app/src/images/<?= $category->image_path ?>">
        </div>
    <?php
    endif; ?>
    <form method="post" enctype="multipart/form-data">
        <?= $form->input('image_path', 'Image de la catégorie', ['type' => 'file']); ?>
        <?= $form->input('nom', 'Nom de la catégorie'); ?>
        <?= $form->selectSendValue('gender', 'Genre', ['Femme', 'Homme']); ?>
        <div class="center">
            <button class="btn waves-effect waves-light">Sauvegarder</button>
        </div>

    </form>
</div>