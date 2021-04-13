

<section id="encart">
<h1 class="orange-text">OLEGSHOP</h1>
</section>
<h2 class="center display-3">Nouveautés</h2>
<section class="row produit_index">
    <?php
    foreach ($derniers as $dernier): ?>
        <div class="col s12 m6 l4 xl4">
            <div class="card card-index">
                <div class="card-image">
                    <img class="image_admin" src="../app/src/images/<?= $dernier->image_path ?>"
                         alt="<?= $dernier->nom ?>">
                </div>
                <div class="card-content">
                    <span class="card-title"><?= $dernier->nom ?></span>                    
                </div>
                <div class="card-action">
                    <a href="index.php?p=products.show&id=<?= $dernier->id ?>">Voir le Produit</a>
                    <p class="btn-floating btn-large teal"><?= $dernier->prix ?> €</p>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>
</section>

<section id="encart2"></section>
<h2 class="center">Meilleures ventes</h2>
<section class="row produit_index">
    <?php
    foreach ($meilleurs as $meilleur) : ?>
        <div class="col s12 m6 l4 xl4">
            <div class="card card-index">
                <div class="card-image">
                    <img class="image_admin" src="../app/src/images/<?= $meilleur->image_path ?>"
                         alt="<?= $meilleur->nom ?>">
                </div>
                <div class="card-content">
                    <span class="card-title"><?= $meilleur->nom ?></span>                    
                </div>
                <div class="card-action">
                    <a href="index.php?p=products.show&id=<?= $meilleur->id ?>">Voir le Produit</a>
                    <p class="btn-floating btn-large teal"><?= $meilleur->prix ?> €</p>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>
</section>

<section class="deal" id="deal">
<div class="icons-container">
    <div class="icons">
        <i class="fas fa-shipping-fast"></i>
        <h3>Livraison rapide</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
    </div>

    <div class="icons">
        <i class="fas fa-user-clock"></i>
        <h3>Support 24*7</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
    </div>
    <div class="icons">
        <i class="fas fa-money-check-alt"></i>
        <h3>Facilité de paiements</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
    </div>

    <div class="icons">
        <i class="fas fa-box"></i>
        <h3>Remboursements sous 14 jours</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
    </div>
</div>

</section>

<section class="newsletter">
    <h1>Newsletter</h1> 
    <p>Contactez-nous pour les derniéres ventes et mise à jours</p>
    <form action="">
        <input type="email" placeholder="entrer votre email">
        <input type="submit" class= btn>
    </form>


</section>