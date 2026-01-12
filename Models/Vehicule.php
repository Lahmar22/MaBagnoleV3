<?php
require_once 'Connection.php';
class Vehicule
{
    private $modele;
    private $marque;
    private $prixParJour;
    private $description;
    private $id_categorie;
    private $image;

    public function __construct($modele = null, $marque = null, $prixParJour = null, $description = null, $id_categorie = null, $image = null) {
        $this->modele = $modele;
        $this->marque = $marque;
        $this->prixParJour = $prixParJour;
        $this->description = $description;
        $this->id_categorie = $id_categorie;
        $this->image = $image;

    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function getContVehicule(){
        $db = Connection::connect();
        $sqlContV = "SELECT COUNT(*) AS total FROM vehicule";
        $stmt = $db->prepare($sqlContV);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function ajouterVehicule(Vehicule $vehicule) {
        $db = Connection::connect();
        $sqlVehicule = "INSERT INTO vehicule (modele, marque, prixParJour, description, id_categorie, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sqlVehicule);
        return $stmt->execute([$vehicule->modele, $vehicule->marque, $vehicule->prixParJour, $vehicule->description, $vehicule->id_categorie, $vehicule->image]);
    }

    public function getAllVehiculees(){
        $db = Connection::connect();
        $sqlVehiculees = "SELECT v.id_Vehicule, v.modele, v.marque, v.prixParJour, v.description, v.id_categorie, v.image, v.statut, c.id_Categorie, c.nomCategorie 
        FROM vehicule v INNER JOIN categorie c ON v.id_categorie = c.id_Categorie";
        $stmt = $db->prepare($sqlVehiculees);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllVehiculeesDisp(){
        $db = Connection::connect();
        $sqlVehiculees = "SELECT v.id_Vehicule, v.modele, v.marque, v.prixParJour, v.description, v.id_categorie, v.image, v.statut, c.id_Categorie, c.nomCategorie 
        FROM vehicule v INNER JOIN categorie c ON v.id_categorie = c.id_Categorie WHERE statut = 'Disponible'";
        $stmt = $db->prepare($sqlVehiculees);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function modifierVehicule(Vehicule $vehicule, $id_vehicule){
        $db = Connection::connect();
        $sqlVehicule = "UPDATE vehicule SET modele = :modele, marque = :marque, prixParJour = :prixParJour, description = :description, id_categorie = :id_categorie, image = :image
        WHERE id_Vehicule = :id_vehicule";
        $stmt = $db->prepare($sqlVehicule);
        return $stmt->execute([
            'id_vehicule' =>$id_vehicule,
            'modele' =>$vehicule->modele,
            'marque' =>$vehicule->marque,
            'prixParJour' =>$vehicule->prixParJour,
            'description' =>$vehicule->description,
            'id_categorie' =>$vehicule->id_categorie,
            'image' =>$vehicule->image
        ]);
    }

    public function supprimerVehicule($id)
    {
        $delete_vehicule = "DELETE FROM vehicule WHERE id_Vehicule = :id";

        $db = Connection::connect();
        $stmt = $db->prepare($delete_vehicule);
        return $stmt->execute(['id' => $id]);
    }

    

}
