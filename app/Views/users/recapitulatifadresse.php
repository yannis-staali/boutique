<section class="nav_etape m-1">
    <nav class="teal darken-1 round-corner height_auto_750">
        <div id="navbarNav round-corner">
            <ul class="etape navbar-nav row round-corner flex-row">
                <li class="nav-item col s3 p-0">
                    <a href="index.php?p=users.recapitulatifpanier"
                       class="nav-link w-100 p-0 flex-around round-corner-left">
                        1 - Vérification du Panier
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item active col s3 p-0">
                    <a href="index.php?p=users.recapitulatifadresse" class="nav-link w-100 p-0 flex-around">
                        2 - Adresse livraison
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0">
                    <a disabled class="nav-link w-100 p-0 flex-around" style="cursor: not-allowed">
                        3 - Paiement
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0">
                    <a disabled class="nav-link w-100 p-0 flex-around round-corner-right" style="cursor: not-allowed">
                        4 - Confirmation
                        <span class="disappear1150"><i class="material-icons">check</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</section>
<section id="adresse_L">
    <form action="" method="POST" class="form_adresse">
        <div class="row">
            <section class="col s12 m6">
                <h5 class="center">Adresse de facturation</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="adresse_facturation" value="<?= $logged_user->adresse_facturation ?>"
                               type="text" class="validate">
                        <label for="adresse_facturation">Adresse</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="ville_facturation" value="<?= $logged_user->ville_facturation ?>"
                               type="text">
                        <label for="ville_facturation">Ville</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="ville_facturation" value="<?= $logged_user->code_postal_facturation ?>"
                               type="text">
                        <label for="ville_facturation">Ville</label>
                    </div>
                </div>
                <p>
                    <label for="meme_adresse">
                        <input type="checkbox" id="meme_adresse" name="meme_adresse">
                        <span>Choisir comme adresse de livraison</span>
                    </label>
                </p>
            </section>
            <section id="info_user" class="col s12 m6">
                <h5 class="center">Adresse de livraison</h5>
                <p>(Si différente de la facturation)</p>
                <?= $form->input('adresse_livraison', 'Adresse de livraison', ['type'=> 'text'], 's12'); ?>
                <?= $form->input('ville_livraison', 'Ville de livraison', ['type'=> 'text'], 's12'); ?>
                <?= $form->input('code_postal_livraison', 'Code postal de livraison', ['type'=> 'text'], 's12'); ?>
            </section>
        </div>
        <section class="between">
            <button name="precedant" value="1" class="btn btn-small waves-effect waves-light teal">
                <i class="material-icons left">chevron_left</i>
                Retour
            </button>
            <button name="suivant" value="1" class="btn btn-small waves-effect waves-light teal">
                Suite
                <i class="material-icons right">chevron_right</i>
            </button>
        </section>
    </form>
</section>

