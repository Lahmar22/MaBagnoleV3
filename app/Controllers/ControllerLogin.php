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

        switch ($user->roleUser) {
            case 'client':
                $_SESSION['id_utilisateur'] = $user->id_utilisateur;
                $_SESSION['email'] = $user->email;
                $_SESSION['nom'] = $user->nom;
                $_SESSION['prenom'] = $user->prenom;

                header("Location: accueil");
                break;
            case 'admin':
                $_SESSION['id_admin'] = $user->id_admin;
                $_SESSION['emailAdmin'] = $user->email;
                $_SESSION['nomAdmin'] = $user->nom;
                $_SESSION['prenomAdmin'] = $user->prenom;

                header("Location: homeAdmin");
                break;
            
        }

        
        exit();
    }
}

$controller = new ControllerLogin();
$controller->verifierLogin();
