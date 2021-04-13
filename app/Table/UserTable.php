<?php

namespace App\Table;

use Core\Table\Table;

class UserTable extends Table
{
    protected $table = "utilisateurs";

    public function lastCommande($id_user)
    {
        return $this->query(
            "
        SELECT *
        FROM commandes
        WHERE id_utilisateurs = ?
        ORDER BY id DESC
        ",
            [$id_user],
            true
        );
    }

    public function current($id_user)
    {
        return $this->query(
            "
        SELECT utilisateurs.id, utilisateurs.password, utilisateurs.email, utilisateurs.prenom, utilisateurs.nom, utilisateurs.adresse_facturation, utilisateurs.ville_facturation, utilisateurs.code_postal_facturation, utilisateurs.adresse_livraison, utilisateurs.ville_livraison, utilisateurs.code_postal_livraison, utilisateurs.telephone, utilisateurs.is_admin
        FROM utilisateurs
        WHERE utilisateurs.id = ?
        ",
            [$id_user],
            true
        );
    }

    public function commandes_user($id)
    {
        return $this->query(
            "
        SELECT commandes.id as id, commandes.date_commande as date_commande, commandes.numero as numero, commandes.prix_commande as prix_commande,
        SUM(produits_commandes.quantite) as count_produits
        FROM commandes
        LEFT JOIN produits_commandes
        ON commandes.numero = produits_commandes.num_commande
        AND commandes.id_utilisateurs = ?
        GROUP BY commandes.id
        ",
            [$id]
        );
    }

    /**
     * Vérifie la disponibilité de l'email
     * @param $email
     * @return boolean
     */
    public function isMailAvailable($email)
    {
        $query = $this->query(
            "
        SELECT email
        FROM utilisateurs
        WHERE email = ?
        ",
            [$email],
            true
        );
        if (!empty($query->email)) {
            return false;
        }
        return true;
    }

    public function isRegistered($email)
    {
        $user = $this->query(
            "
        SELECT *
        FROM utilisateurs
        WHERE email = ?
        ",
            [$email],
            true
        );
        if (!empty($user->email)) {
            return $user;
        }
        return false;
    }

    public function hasBasket()
    {
        if (isset($_SESSION['panier'])) {
            return $_SESSION['panier'];
        }
        return false;
    }
}