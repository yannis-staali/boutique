<h4 class="center">Administrer les catégories</h4>

<p class="center">
    <a href="?p=admin.categories.add" class="btn btn-medium waves-effect waves-light green"><i
                class="left material-icons">add_circle</i>Ajouter une catégorie</a>
</p>
<div class="row">
    <div class="col s6 m6 ">
        <h5 class="center-align">FEMMES</h5>
        <div class="divider"></div>
        <?php
        foreach ($categories as $category) :
            if ($category->gender === 'Femme') :?>
                <div class="col s12 m12 l6">
                    <div class="card">
                        <div class="card-image">
                            <img src="../app/src/images/<?= $category->image_path ?>">
                            <span class="card-title black-text"><?= strtoupper($category->gender) ?><div
                                        class="divider"></div><?= $category->nom ?></span>
                        </div>

                        <div class="card-action center">
                            <a class="btn btn-small waves-effect waves-light teal"
                               href="?p=admin.categories.edit&id=<?= $category->id ?>">Editer</a>
                            <form action="?p=admin.categories.delete" method="post" style="display: inline">
                                <input  type="hidden" name="id" value="<?= $category->id ?>">
                                <button type="submit" class="btn btn-small waves-effect waves-light red darken-3">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach; ?>
    </div>
    <div class="col s6 m6">
        <h5 class="center-align">HOMMES</h5>
        <div class="divider"></div>
        <?php
        foreach ($categories as $category) :
            if ($category->gender === 'Homme') :?>
                <div class="col s12 m12 l6">
                    <div class="card">
                        <div class="card-image">
                            <img src="../app/src/images/<?= $category->image_path ?>">
                            <span class="card-title black-text"><?= strtoupper($category->gender) ?><div
                                        class="divider"></div><?= $category->nom ?></span>
                        </div>
                        <div class="card-action center">
                            <a class="btn btn-small waves-effect waves-light teal"
                               href="?p=admin.categories.edit&id=<?= $category->id ?>">Editer</a>
                            <form action="?p=admin.categories.delete" method="post" style="display: inline">
                                <input type="hidden" name="id" value="<?= $category->id ?>">
                                <button type="submit" class="btn btn-small waves-effect waves-light red darken-3">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach; ?>
    </div>
</div>