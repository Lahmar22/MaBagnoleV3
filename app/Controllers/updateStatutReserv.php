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

            header("Location: reservationAdmin");
            exit();
        } catch (PDOException) {
            header("Location: reservationAdmin");
            exit();
        }
    }
}

$remove = new UpdateStatutReserv();
$remove->updateStatutResv();