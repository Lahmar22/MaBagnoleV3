<?php

require_once '../Models/Article.php';

class FilterByTags
{
    public function filtre()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return; 
        }

        try {
            $tage = $_POST["tage"];
            $themeId = $_POST["themeId"];


            if(!empty($tage)) {
                 $clientSerch = new Article();
                $clientSerch->filtreByTags($tage, $themeId);
                header("Location: ../Views/client/articlePage.php?tags=$tage&themeId=$themeId");
                exit();
            }

            exit();
        } catch (PDOException $e) {
            echo "<pre>";
            echo "DB ERROR : " . $e->getMessage();
            echo "</pre>";
            exit();
        } 
    }
}

$controller = new FilterByTags();
$controller->filtre();