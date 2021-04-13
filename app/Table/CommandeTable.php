<?php

namespace App\Table;

use Core\Table\Table;

class CommandeTable extends Table
{
    protected $table = "commandes";

/*    public function informations($id)
    {
        return $this->query(
            "
        SELECT *
        FROM commandes
        WHERE id = ?
        ",
            [$id],
            true
        );
    }*/

    public function findWithUser($id_user){
        return $this->query(
            "
        SELECT commandes.id as id, commandes.date_commande as date_commande, commandes.numero as numero, commandes.prix_commande as prix_commande,
        SUM(produits_commandes.quantite) as count_produits
        FROM commandes
        LEFT JOIN produits_commandes
        ON commandes.numero = produits_commandes.num_commande
        WHERE commandes.id_utilisateurs = ?
        GROUP BY commandes.id
        ",
            [$id_user]
        );
    }

}