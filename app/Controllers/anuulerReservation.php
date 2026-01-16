<?php

require_once __DIR__ . '/../Models/Reservation.php';

class AnuulerReservation
{

    public function annulerReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        try {
            $id = $_POST["id_Reservation"];
 
            $reserve = new Reservation();
            $reserve->annulerReservation($id);

            header("Location: reservation");

            exit();
        } catch (PDOException) {
            header("Location: reservation");
            exit();
        }
    }
}

$remove = new AnuulerReservation();
$remove->annulerReservation();