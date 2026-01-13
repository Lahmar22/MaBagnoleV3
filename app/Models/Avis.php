<?php 
class Avis{
    private $idAvis;
    private $note;
    private $commentaire;
    private $dateAvis;
    private $isDeleted;
    private $description;

    public function __construct($idAvis, $note, $commentaire, $dateAvis, $isDeleted, $description){
        $this->idAvis = $idAvis;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->dateAvis = $dateAvis;
        $this->isDeleted = $isDeleted;
        $this->description = $description;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }
}