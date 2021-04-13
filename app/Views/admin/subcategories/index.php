<?php

if (isset($message)): ?>

<?php
endif;
?>

<h4 class="center">Administrer les sous-catégories</h4>

<p class="center">
    <a href="?p=admin.subcategories.add" class="btn btn-medium waves-effect waves-light green"><i
                class="left material-icons">add_circle</i>Ajouter une sous-catégorie</a>
</p>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Catégorie</th>
        <th>Sous-catégorie</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $i = 0;
    foreach ($subcategories as $subcategory) :
        $i++; ?>
        <tr>
            <td><?= $i ?></td>
            <?php
            foreach ($categories as $category) : ?>
                <?php
                if ($category->id == $subcategory->id_categories) : ?>
                    <td>(<?= $category->gender ?>) | <?= $category->nom ?></td>
                <?php
                endif;
            endforeach; ?>
            <td><?= $subcategory->nom ?></td>
            <td><a class="btn btn-small waves-effect waves-light teal"
                   href="?p=admin.subcategories.edit&id=<?= $subcategory->id ?>">Editer</a>
                <form action="?p=admin.subcategories.delete" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?= $subcategory->id ?>">
                    <button type="submit" class="btn btn-small waves-effect waves-light red darken-3">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>