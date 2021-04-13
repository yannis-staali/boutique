<?php

namespace App\Entity;

use Core\Entity\Entity;

class ProductEntity extends Entity{

    public function getUrl(){
        return 'index.php?p=products.show&id=' . $this->id;
    }

    public function getContenu(){
        $html = '<p>' . substr($this->description, 0, 100) . '...</p>';
        return $html;
    }

    public function getGender($subcategories, $categories){
        foreach ($subcategories as $subcategory){
            if ($this->sous_categorie == $subcategory->nom){
                foreach ($categories as $category){
                    if ($subcategory->id_categories == $category->id){
                        return $category->gender;
                    }
                }
            }
        }
    }

    public function getCategory($subcategories, $categories){
        foreach ($subcategories as $subcategory){
            if ($this->sous_categorie == $subcategory->nom){
                foreach ($categories as $category){
                    if ($subcategory->id_categories == $category->id){
                        return [$category->nom, $category->id];
                    }
                }
            }
        }
    }
}