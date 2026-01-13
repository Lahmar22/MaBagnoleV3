<?php
require_once 'Connection.php';
class Reservation{
    private $dateDebut;
    private $dateFin;
    private $lieuPrise;
    private $lieuRetour;
    private $id_utilisateur;
    private $id_vehicule;

    public function __construct( $dateDebut = null, $dateFin = null, $lieuPrise = null , $lieuRetour = null, $id_vehicule = null, $id_utilisateur = null) {
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->lieuPrise = $lieuPrise;
        $this->lieuRetour = $lieuRetour;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_vehicule = $id_vehicule;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function reservationVehicule(Reservation $reservation) {
        $db = Connection::connect();
        $reserve = "INSERT INTO reservation (dateDebut, dateFin, lieuPrise, lieuRetour, id_vehicule, id_utilisateur) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($reserve);
        return $stmt->execute([$reservation->dateDebut,
        $reservation->dateFin, $reservation->lieuPrise, $reservation->lieuRetour,
        $reservation->id_vehicule, $reservation->id_utilisateur]);
    }

    public function getReservation($id){
        $db = Connection::connect();
        $reserve = "SELECT r.id_Reservation, r.dateDebut, r.dateFin, r.lieuPrise, r.lieuRetour, r.statut, r.id_vehicule, r.id_utilisateur, v.id_Vehicule, v.modele, v.marque, v.prixParJour, v.image, u.nom, u.prenom 
        FROM reservation r INNER JOIN vehicule v ON r.id_vehicule = v.id_Vehicule 
        INNER JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur WHERE r.id_utilisateur = :id";
        $stmt = $db->prepare($reserve);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getAllReservation(){
        $db = Connection::connect();
        $reserve = "SELECT r.id_Reservation, r.dateDebut, r.dateFin, r.lieuPrise, r.lieuRetour, r.statut, r.id_vehicule, r.id_utilisateur, v.id_Vehicule, v.modele, v.marque, v.prixParJour, v.image, u.nom, u.prenom 
        FROM reservation r INNER JOIN vehicule v ON r.id_vehicule = v.id_Vehicule 
        INNER JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur";
        $stmt = $db->prepare($reserve);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function annulerReservation($id){
        $db = Connection::connect();
        $reserve = "DELETE FROM reservation WHERE id_Reservation = :id";
        $stmt = $db->prepare($reserve);
        return $stmt->execute(['id' => $id]);

    }

    public function modifierStatutResv($id, $statut){
        $db = Connection::connect();
        $reserve = "UPDATE reservation SET statut = :statut WHERE id_Reservation = :id";
        $stmt = $db->prepare($reserve);
        return $stmt->execute(['id' => $id, 'statut' => $statut]);

    }
}