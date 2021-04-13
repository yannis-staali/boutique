<section id="container-register">
        <form action="" method="POST">
            <h3>CRÉER MON COMPTE</h3>
            <section id="box-form">
                    <label>Email:</label>
                    <input type="text" name="email" placeholder="email@email.com*" value="<?php
                     echo $email = (isset($_POST['email'])) ? $_POST['email'] : '' ?>" required>

                    <section id="box-password">
                        <label for="password">Mot de passe:</label>
                        <input type="password" name="password" placeholder="mot de passe*" value="<?php
                        echo $password = (isset($_POST['password'])) ? $_POST['password'] : '' ?>" required>
                        <label for="conf_password">confirmation mot de passe:</label>
                        <input type="password" name="password_confirm" placeholder="confirmer le mot de passe*" value="<?php
                        echo $password_confirm = (isset($_POST['password_confirm'])) ? $_POST['password_confirm'] : '' ?>" required>

                    </section>

                    
                    
                    <label>Nom:</label>
                    <input type="text" name="nom" placeholder="nom*" value="<?php
                echo $nom = (isset($_POST['nom'])) ? $_POST['nom'] : '' ?>" required>
                    <label>Prénom:</label>
                    <input type="text" name="prenom" placeholder="prénom*" value="<?php
                echo $prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : '' ?>" required>
                    <label>Telephone:</label>
                    <input type="tel" name="telephone" placeholder="0123456789*" value="<?php
                echo $telephone = (isset($_POST['telephone'])) ? $_POST['telephone'] : '' ?>">
                    <label>adresse:</label>
                    <input type="text" name="adresse" placeholder="adresse*" value="<?php
                echo $adresse = (isset($_POST['adresse'])) ? $_POST['adresse'] : '' ?>" required>
                    <label>Ville:</label>
                    <input type="text" name="ville" placeholder="ville*" value="<?php
                echo $ville = (isset($_POST['ville'])) ? $_POST['ville'] : '' ?>" required>
                    <label>Code postal:</label>
                    <input type="text" name="cp" placeholder="code postale*" value="<?php
                echo $cp = (isset($_POST['cp'])) ? $_POST['cp'] : '' ?>" required>
            </section>
            <section id="box-newsletter">
                
            </section>
            <button type="submit" name="valid_insc">Enregistrer vos informations</button>
        </form>
    </section>
    </form>
</div>