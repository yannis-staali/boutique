<?php

namespace App\Table;

use Core\Table\Table;

class ProductCommandeTable extends Table
{
    protected $table = "produits_commandes";

    public function productsFromCommande($num_commande){
        return $this->query("
        SELECT *
        FROM produits
        LEFT JOIN produits_commandes
        ON produits.id = produits_commandes.id_produit
        WHERE produits_commandes.num_commande = ?
        ", [$num_commande]);
    }

}