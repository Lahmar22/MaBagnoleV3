<?php

require_once __DIR__ . '/../Models/Vehicule.php';

class SupprimerVehicule
{

    public function supprimervehicule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        try {
            $id = $_POST["id_Vehicule"];

            $vehicule = new Vehicule();
            $vehicule->supprimerVehicule($id);

            header("Location: ../Views/admin/home.php?success=1");
            exit();
        } catch (PDOException) {
            header("Location: ../Views/admin/home.php?error=db");
            exit();
        }
    }
}

$remove = new SupprimerVehicule();
$remove->supprimervehicule();