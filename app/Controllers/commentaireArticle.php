<?php

require_once '../Models/CommentaireArticle.php';

class CommentaireArticle
{
    public function commentaireArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $idarticle = trim($_POST["idarticle"]);
            $contenu = trim($_POST["commentaire"]);
            $iduser = trim($_POST["iduser"]);
            

            $comtr = new CommentaireArt($contenu ,$idarticle, $iduser);

            $comntAdd = new CommentaireArt();
            $comntAdd->ajouteCommentaire($comtr);


            header("Location: ../Views/client/detaitArticle.php?idArticle=$idarticle");
            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new CommentaireArticle();
$controller->commentaireArticle();