<?php

require_once '../Models/Article.php';

class SercherArticle
{
    public function sercher()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $articleSearch = $_POST["articleSearch"];
            $theme = $_POST["theme"];

            if(empty($articleSearch)) {
                header("Location: ../Views/client/articlePage.php?id=$theme");
                exit();
            }

            $clientSerch = new Article();
            $clientSerch->sercheBytitre($articleSearch);


            header("Location: ../Views/client/articlePage.php?titre=$articleSearch&id=$theme");
            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new SercherArticle();
$controller->sercher();