<?php

class Logout
{

    public function logout()
    {
        session_start();

        session_unset();

        session_destroy();

       require __DIR__ . '/../Views/login.php';
        exit();
    }
}

$logout = new Logout();
$logout->logout();