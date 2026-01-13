<?php 
require_once 'Connection.php';
class Categorie{
    private $nomCategorie;
    private $description;

    public function __construct($nomCategorie = null, $description = null){
        $this->nomCategorie = $nomCategorie;
        $this->description = $description;

    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function ajouterCategorie(Categorie $categorie){
        $db = Connection::connect();
        $sqlCategorie = "INSERT INTO categorie (nomCategorie, description_categorie) VALUES (?, ?)";
        $stmt = $db->prepare($sqlCategorie);
        return $stmt->execute([$categorie->nomCategorie, $categorie->description]);
    }

    public function getAllCategorie(){
        $db = Connection::connect();
        $sqlCategorie = "SELECT * FROM categorie";
        $stmt = $db->prepare($sqlCategorie);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}