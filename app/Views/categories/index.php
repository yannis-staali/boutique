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
                            <a href="<?= $category->url; ?>"><img src="../app/src/images/<?= $category->image_path ?>">
                                <span class="card-title black-text"><?= strtoupper($category->gender) ?><div
                                            class="divider"></div><?= $category->nom ?></span></a>
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
                            <a href="<?= $category->url; ?>"><img src="../app/src/images/<?= $category->image_path ?>">
                                <span class="card-title black-text"><?= strtoupper($category->gender) ?><div
                                            class="divider"></div><?= $category->nom ?></span></a>
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach; ?>
    </div>
</div>