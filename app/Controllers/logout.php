<?php

class Logout
{

    public function logout()
    {
        session_start();

        session_unset();

        session_destroy();

        header("Location: ../Views/login.php");
        exit();
    }
}

$logout = new Logout();
$logout->logout();