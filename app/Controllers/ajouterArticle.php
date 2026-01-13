<?php

require_once '../Models/Article.php';

class AjouterArticle
{
    public function ajouterArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $titreArticle = trim($_POST["titreArticle"]);
            $contenu = trim($_POST["contenu"]);
            $tags = trim($_POST["tags"]);
            $idTheme = trim($_POST["idTheme"]);

            $article = new Article($titreArticle, $contenu, $tags, $idTheme);

            $articleAdd = new Article();
            $articleAdd->ajouterArticle($article);


            header("Location: ../Views/client/articlePage.php?id=$idTheme");
            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new AjouterArticle();
$controller->ajouterArticle();