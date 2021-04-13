<section class="nav_etape m-1">
    <nav class="teal darken-1 round-corner height_auto_750">
        <div id="navbarNav round-corner" >
            <ul class="etape navbar-nav row round-corner flex-row">
                <li class="nav-item col s3 p-0">
                    <a href="index.php?p=users.recapitulatifpanier" class="nav-link w-100 p-0 flex-around round-corner-left">
                        1 - Vérification du Panier
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0">
                    <a href="index.php?p=users.recapitulatifadresse" class="nav-link w-100 p-0 flex-around">
                        2 - Adresse livraison
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0 active">
                    <a href="index.php?p=users.paiement" class="nav-link w-100 p-0 flex-around">
                        3 - Paiement
                        <span class="disappear1150"><i class="material-icons">arrow_forward</i></span>
                    </a>
                </li>
                <li class="nav-item col s3 p-0 round-corner-right">
                    <a disabled class="nav-link w-100 p-0 flex-around round-corner-right" style="cursor: not-allowed">
                        4 - Confirmation
                        <span class="disappear1150"><i class="material-icons">check</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</section>
    <?php
    if (isset($retourpanier) && $retourpanier == true) {
        ?>
        <button class="btn bouton modif_p"><a href="panier.php">Modifier le panier</a></button>
        <?php
        $retourpanier = false;
    }
    ?>
    <section class="row center-align">
        <h4 class="center-align">Valider le paiement</h4>
        <form action="" method="POST" id="form_paiement" class="col offset-m2 m8 s12">
            <div class="col s12">
                <div class="input-field">
                    <label for="carte">Numero de carte:</label>
                    <input type="text" class="validate" name="carte" id="carte"
                           value="<?= $carte = (isset($_POST['carte']) ? $_POST['carte'] : '') ?>">
                </div>
            </div>
            <div class="col s12 m3">
                <label class="center" for="date_p">Date d'expiration:</label>
                <div class="input-field">
                    <input type="month" class="validate" name="date_p" id="date_p"
                           value="<?= $carte = (isset($_POST['date_p']) ? $_POST['date_p'] : $date_min) ?>"
                           min="<?= $date_min ?>">
                </div>
            </div>
            <div class="col offset-s3 s6 offset-m4 m5">
                <label class="center" for="crypto">Cryptogramme de sécurité:</label>
                <div class="input-field">
                    <input type="text" class="validate" name="crypto" id="crypto"
                           value="<?= $carte = (isset($_POST['crypto']) ? $_POST['crypto'] : '') ?>">
                </div>
            </div>
            <div class="valid_form col s12">
                <button type="submit" class="btn btn-small waves-effect waves-light teal" name="valid_pay" value="1">Payer</button>
                <br>
                <small><span class="oblig">*</span>Tous les champs sont obligatoires</small>
            </div>
        </form>
    </section>
