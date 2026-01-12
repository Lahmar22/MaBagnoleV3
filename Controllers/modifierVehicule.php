<?php
require_once '../Models/Vehicule.php';
class ModifierVehicule{
    public function modifiervehicule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $id_vehicule = $_POST["id_vehicule"];
            $modele = trim($_POST["modele"]);
            $categorie = trim($_POST["categorie"]);
            $prixParJour = trim($_POST["prixParJour"]);
            $marque = trim($_POST["marque"]);
            $image = trim($_POST["image"]);
            $description = trim($_POST["description"]);
            

            $vehicule = new Vehicule($modele, $marque, 
            $prixParJour, $description, 
            $categorie, $image);

            $adminVecl = new Vehicule();
            $adminVecl->modifierVehicule($vehicule, $id_vehicule);


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

$update = new ModifierVehicule();
$update->modifiervehicule();