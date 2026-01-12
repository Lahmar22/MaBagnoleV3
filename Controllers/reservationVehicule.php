<?php

require_once '../Models/Reservation.php';

class ReservationVehicule
{
    public function reservation()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $id_user = $_POST["id_user"];
            $id_vehicule = $_POST["id_vehicule"];
            
            $dateDebut = trim($_POST["dateDebut"]);
            $dateFin = trim($_POST["dateFin"]);
            $lieuPrise = trim($_POST["lieuPrise"]);
            $lieuRetour = trim($_POST["lieuRetour"]);

            $reservation = new Reservation($dateDebut, $dateFin, 
            $lieuPrise, $lieuRetour, $id_vehicule, $id_user);

            $clientResv = new Reservation();
            $clientResv->reservationVehicule($reservation);


            header("Location: ../Views/client/vehicule.php?success=1");
            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new ReservationVehicule();
$controller->reservation();