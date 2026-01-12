<?php

require_once '../Models/Vehicule.php';

class AjouterVehicule
{
    public function ajoutervehicule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $modele = $_POST["modele"];
            $categorie = trim($_POST["categorie"]);
            $prixParJour = trim($_POST["prixParJour"]);
            $marque = trim($_POST["marque"]);
            $image = trim($_POST["image"]);
            $description = trim($_POST["description"]);
            

            $vehicule = new Vehicule($modele, $marque, 
            $prixParJour, $description, 
            $categorie, $image);

            $adminCatg = new Vehicule();
            $adminCatg->ajouterVehicule($vehicule);


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

$controller = new AjouterVehicule();
$controller->ajoutervehicule();