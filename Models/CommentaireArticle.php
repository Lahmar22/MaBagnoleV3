<?php 
    require_once 'Connection.php';
    class CommentaireArt
    {
        private $contenu;
        private $idArticle;
        private $idUser;

        public function __construct($contenu = null, $idArticle = null, $idUser = null){
            $this->contenu = $contenu;
            $this->idArticle = $idArticle;
            $this->idUser = $idUser;
        }


        public function __get($name) {
            return $this->$name;
        }

        public function __set($property, $value) {
            $this->$property = $value;
        }

        public function ajouteCommentaire(CommentaireArt $comtr){
            $db = Connection::connect();
            $sqlComment = "INSERT INTO commentaire (contenu, idArticle, idUser) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sqlComment);
            return $stmt->execute([$comtr->contenu, $comtr->idArticle, $comtr->idUser]);   
        }

        public function getAllCommentaire($idartcl){
            $db = Connection::connect();
            $sqlComment = "SELECT c.idComnt, c.contenu, c.idArticle, u.id_utilisateur, u.nom, u.prenom
            FROM commentaire c INNER JOIN utilisateur u ON c.idUser = u.id_utilisateur 
            WHERE c.idArticle = :idartcl";
            $stmt = $db->prepare($sqlComment);
            $stmt->execute(['idartcl' => $idartcl]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }


    }