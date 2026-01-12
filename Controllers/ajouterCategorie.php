<?php

require_once '../Models/Categorie.php';

class AjouterCategorie
{
    public function ajouterCategorie()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $categorie = trim($_POST["categorie"]);
            $descriptionCategorie = trim($_POST["descriptionCategorie"]);
            

            $categorie = new Categorie(
                $categorie,
                $descriptionCategorie  
            );

            $adminCatg = new Categorie();
            $adminCatg->ajouterCategorie($categorie);


            header("Location: ../Views/admin/home.php?success=1");
            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new AjouterCategorie();
$controller->ajouterCategorie();