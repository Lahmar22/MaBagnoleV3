<?php
require_once '../Models/Utilisateur.php';

class Inscription
{
    public function inscription()
    {
        try {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

        

            $user = new Utilisateur();
            $user->inscription($nom, $prenom, $email, $hash);

            header('Location: ../Views/login.php');
            exit();
        } catch (PDOException $e) {
            echo '<pre>';
            echo 'DB ERROR : ' . $e->getMessage();
            echo '</pre>';
            exit();
        }
    }
}

$inscription = new Inscription();
$inscription->inscription();