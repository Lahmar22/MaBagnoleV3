<?php

require_once __DIR__ . '/../Models/Reservation.php';

class UpdateStatutReserv
{

    public function updateStatutResv()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        try {
            $id = $_POST["id_reseve"];
            $statutsResv = $_POST["statutsResv"];

            $reserve = new Reservation();
            $reserve->modifierStatutResv($id, $statutsResv);

            header("Location: ../Views/admin/reservation.php?success=1");
            exit();
        } catch (PDOException) {
            header("Location: ../Views/admin/reservation.php?error=db");
            exit();
        }
    }
}

$remove = new UpdateStatutReserv();
$remove->updateStatutResv();