<h4 class="center">Modifier votre profil</h4>
<form class="col s12" method="POST" action="">
    <h5 class="">Informations relatives au compte</h5>
    <?= $form->input('email', 'Email'); ?>
    <div class="input-field col s12 m12 l6 xl6">
        <label for="now_password">Mot de passe actuel</label>
        <input type="password" class="form-control" name="now_password" id="now_password">
    </div>
    <div class="input-field col s12 m12 l6 xl6">
        <label for="new_password">Nouveau mot de passe</label>
        <input type="password" class="form-control" name="new_password" id="new_password">
    </div>
    <div class="input-field col s12 m12 l6 xl6">
        <label for="password_confirm">Confirmation nouveau mot de passe</label>
        <input type="password" class="form-control" name="password_confirm" id="password_confirm">
    </div>
    <h5 class="">Informations personnelles</h5>
    <?= $form->input('nom', 'Nom'); ?>
    <?= $form->input('prenom', 'Prénom'); ?>
    <?= $form->input('telephone', 'Téléphone'); ?>
    <div class="row">
        <section class="col s6">
            <h5 class="">Adresse de facturation</h5>
            <?= $form->input('adresse_facturation', 'Adresse facturation'); ?>
            <?= $form->input('ville_facturation', 'Ville'); ?>
            <?= $form->input('code_postal_facturation', 'Code postal facturation'); ?>
        </section>
        <section class="col s6">
            <h5 class="">Adresse de livraison</h5>
            <?= $form->input('adresse_livraison', 'Adresse livraison'); ?>
            <?= $form->input('ville_livraison', 'Ville livraison'); ?>
            <?= $form->input('code_postal_livraison', 'Code postal livraison'); ?>
        </section>
    </div>

    <div class="center">
        <button class="btn waves-effect waves-light" name="submit_profil" value="1">Envoyer</button>
    </div>
</form>
<section id="historique" class="m-1">
    <h4>Historique des achats</h4>
    <?php if (empty($user_commandes)): ?>
    <p>Vous n'avez pas encore effectué de commande</p>
    <?php else : ?>
    <section id="tableau_historique">
        <table class=" histo">
            <thead class="grey lighten-4">
            <tr>
                <th>Date</th>
                <th>Numéro de commande</th>
                <th>Nombre de produits</th>
                <th>Prix</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($user_commandes as $user_commande) : ?>
                <tr>
                    <td>
                        <?= $user_commande->date_commande = date('d-m-Y') ?>
                    </td>
                    <td>
                        <a href="<?= $user_commande->url ?>"><?= $user_commande->numero ?></a>
                    </td>
                    <td>
                        <?php
                        if ($user_commande->count_produits == null): ?>
                            1
                        <?php
                        else: echo $user_commande->count_produits; ?>
                        <?php
                        endif; ?>
                    </td>
                    <td>
                        <?= number_format($user_commande->prix_commande, 2, ',', '') ?> €
                    </td>
                </tr>

            <?php
            endforeach; ?>
            </tbody>
        </table>
    </section>
    <?php endif; ?>
</section>