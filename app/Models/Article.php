<?php 
    require_once 'Connection.php';
    class Article
    {
        private $titreArticle;
        private $contenu;
        private $tags;
        private $idTheme;

        public function __construct($titreArticle = null, $contenu = null, $tags = null, $idTheme = null){
            $this->titreArticle = $titreArticle;
            $this->contenu = $contenu;
            $this->tags = $tags;
            $this->idTheme = $idTheme;

        }

        public function __get($name) {
            return $this->$name;
        }

        public function __set($property, $value) {
            $this->$property = $value;
        }

        public function getArticle($idThme){
            $db = Connection::connect();
            $sqlArticle = "SELECT idArticle, titreArticle, contenu, tags, idTheme FROM article WHERE idTheme = :idThme";
            $stmt = $db->prepare($sqlArticle);
            $stmt->execute(['idThme' => $idThme]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getArticleByid($idart){
            $db = Connection::connect();
            $sqlArticle = "SELECT idArticle, titreArticle, contenu, tags, idTheme FROM article WHERE idArticle = :idart";
            $stmt = $db->prepare($sqlArticle);
            $stmt->execute(['idart' => $idart]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function ajouterArticle(Article $article){
            $db = Connection::connect();
            $sqlArticle = "INSERT INTO article (titreArticle, contenu, tags, idTheme) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sqlArticle);
            return $stmt->execute([$article->titreArticle, $article->contenu, $article->tags, $article->idTheme]);
        }

        public function sercheBytitre($titre){
            $db = Connection::connect();
            $sqlArticle =  "SELECT idArticle, titreArticle, contenu, tags, idTheme FROM article WHERE titreArticle = :titre ";
            $stmt = $db->prepare($sqlArticle);
            $stmt->execute(["titre"=> $titre]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function filtreByTags($tags, $idTheme){ 
            $db = Connection::connect();
            $sqlArticle =  "SELECT idArticle, titreArticle, contenu, tags, idTheme FROM article WHERE tags LIKE :tags AND idTheme = :idTheme";
            $stmt = $db->prepare($sqlArticle);
            $stmt->execute(["tags"=> "%$tags%", "idTheme"=>$idTheme]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }