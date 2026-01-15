<?php
session_start();

require_once __DIR__ . '/../Models/Utilisateur.php';

class ControllerLogin
{
    public function verifierLogin()
    {
        if (!isset($_POST['email'], $_POST['password'])) {
            header('Location: ../Views/login.php?error=empty_fields');
            exit();
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $login = new Utilisateur();
        $user = $login->login($email);

        if (!$user) {
            header('Location: ../Views/login.php?error=user_not_found');
            exit();
        }

        if (!password_verify($password, $user->password)) {
            header('Location: ../Views/login.php?error=wrong_password');
            exit();
        }

        $_SESSION['id_utilisateur'] = $user->id_utilisateur;
        $_SESSION['email'] = $user->email;
        $_SESSION['nom'] = $user->nom;
        $_SESSION['prenom'] = $user->prenom;

        // header('Location: /../Views/client/home.php');
        require __DIR__ . '/../Views/client/home.php';
        exit();
    }
}

$controller = new ControllerLogin();
$controller->verifierLogin();


