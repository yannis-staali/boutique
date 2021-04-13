<div class="p-1">
    <form method="post">
        <?= $form->input('nom', 'Nom de la sous-catégorie'); ?>
        <?= $form->selectSendId('id_categories', 'Catégorie', $categories_names, $categoriesgender); ?>
        <div class="center">
            <button class="btn waves-effect waves-light">Sauvegarder</button>
        </div>
    </form>
</div>