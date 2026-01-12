<?php
require_once '../Models/Reservation.php';

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

            header("Location: ../Views/client/reservation.php?success=1");
            exit();
        } catch (PDOException) {
            header("Location: ../Views/client/reservation.php?error=db");
            exit();
        }
    }
}

$remove = new AnuulerReservation();
$remove->annulerReservation();