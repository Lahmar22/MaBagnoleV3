<?php 
require_once __DIR__ . '/../../config/Connection.php';

class Utilisateur{
    private $nom;
    private $prenom;
    private $email;
    private $password;


    public function __construct($nom = null, $prenom = null, $email = null, $password = null){
       $this->nom = $nom;
       $this->prenom = $prenom;
       $this->email = $email;
       $this->password = $password;
       
    }

    // public function getAllUser()
    // {
    //     $db = Database::connect();
    //     $allUser = "SELECT id_user, nom, prenom, email, role, statuse FROM utilisateur";
    //     $stmt = $db->prepare($allUser);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    // public function removeUser($id)
    // {
    //     $delete_user = "DELETE FROM utilisateur WHERE id_user = :id";

    //     $db = Database::connect();
    //     $stmt = $db->prepare($delete_user);
    //     return $stmt->execute(['id' => $id]);
    // }

    // public function statisticUser()
    // {
    //     $db = Database::connect();
    //     $allUser = "SELECT role, COUNT(*) AS total FROM utilisateur GROUP BY role";
    //     $stmt = $db->prepare($allUser);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    public function login($email){

        $db = Connection::connect();

        $sqlUser = "SELECT *, 'client' as roleUser FROM utilisateur WHERE email = :email";
        

        $stmt = $db->prepare($sqlUser);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if($user){
            return $user;
        }

        $sqladmin = "SELECT *, 'admin' as roleUser FROM administrator WHERE email = :email";

        $stmt2 = $db->prepare($sqladmin);
        $stmt2->execute(['email' => $email]);
        $admin = $stmt2->fetch(PDO::FETCH_OBJ);

        return $admin;


    }

    public function inscription($nom, $prenom, $email, $password){
        $db = Connection::connect();
        $sqlInscription = "INSERT INTO utilisateur(nom, prenom, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sqlInscription);
        $stmt->execute([$nom, $prenom, $email, $password]);
    }


    public function getNom(){
        return $this->nom;
    }
    public function setName($nom){
        $this->nom=$nom;
    }
    
    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($prenom){
        $this->prenom=$prenom;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$email;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password=$password;
    }
    

}
?>