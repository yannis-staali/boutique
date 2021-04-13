<?php


namespace App\Table;

use Core\Table\Table;

class ProductTable extends Table
{
    protected $table = "produits";

    /**
     * Récupère les derniers produits
     * @return array
     */
    public function last()
    {
        return $this->query(
            "
        SELECT produits.stock, produits.id, produits.nom, produits.image_path, produits.description, produits.prix, sous_categories.nom as sous_categorie, categories.nom as categorie
        FROM produits
        LEFT JOIN sous_categories ON id_sous_categories = sous_categories.id
        LEFT JOIN categories ON id_categories = categories.id
        "
        );
    }

    /**
     * Récupère les derniers produits de la sous-catégorie demandée
     * @param $subcategory_id int
     * @return array
     */
    public function lastBySubcategory($subcategory_id)
    {
        return $this->query(
            "
        SELECT produits.stock, produits.id, produits.nom, produits.image_path, produits.description, produits.prix, sous_categories.nom as sous_categorie
        FROM produits
        LEFT JOIN sous_categories ON id_sous_categories = sous_categories.id
        WHERE produits.id_sous_categories = ?",
            [$subcategory_id]
        );
    }

    /**
     * Récupère les derniers produits de la catégorie demandée
     * @param $category_id int
     * @return array
     */
    public function lastByCategory($category_id)
    {
        return $this->query(
            "
        SELECT produits.stock, produits.id, produits.nom, produits.image_path, produits.description, produits.prix, categories.gender, sous_categories.nom as sous_categorie, categories.nom as categorie
        FROM produits 
        LEFT JOIN sous_categories ON id_sous_categories = sous_categories.id
        LEFT JOIN categories ON id_categories = categories.id
        WHERE sous_categories.id_categories = ?",
            [$category_id]
        );
    }

    /**
     * Récupère un produit en liant la sous-catégorie associée
     * @param $id int
     * @return \App\Entity\PostEntity
     */
    public function findWithSubcategory($id)
    {
        return $this->query(
            "
        SELECT produits.stock, produits.id, produits.nom, produits.image_path, produits.description, produits.prix, produits.id_sous_categories, sous_categories.nom as sous_categorie
        FROM produits
        LEFT JOIN sous_categories ON id_sous_categories = sous_categories.id
        WHERE produits.id = ?",
            [$id],
            true
        );
    }

    public function isAvailableForThisQuantity($id_produit, $quantite){
        $stockavailable = $this->query("
        SELECT stock
        FROM produits
        WHERE id = ?
        ",
        [$id_produit],
        true);
        if ((int)$quantite <= $stockavailable->stock){
            return true;
        }
        return false;
    }

    public function dernier(){
        return $this->query("SELECT * FROM produits ORDER BY id DESC LIMIT 3");
    }

    public function meilleur(){
        return $this->query("SELECT * FROM produits_commandes INNER JOIN produits ON produits_commandes.id_produit=produits.id ORDER BY quantite DESC LIMIT 3");
    }

}