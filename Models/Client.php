<?php


class Client extends Utilisateur
{
    public function __construct($nom = null, $prenom = null, $email = null, $password = null)
    {
        parent::__construct($nom = null, $prenom = null, $email = null, $password = null);
    }

    // public function updateStatut($status, $id){
    //     $db = Database::connect();
    //     $sqlUpdateStatut = "UPDATE utilisateur SET statuse = :status WHERE id_user = :id";
    //     $stmt = $db->prepare($sqlUpdateStatut);
    //     return $stmt->execute(['id'  => $id, 'status' => $status]);

    // }

}