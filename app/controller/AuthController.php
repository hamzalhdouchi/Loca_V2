<?php
session_start();
require_once __DIR__ . "/../config/db.php";

class Person
{
    protected $email;
    protected $password;
    protected $connect;
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function loginUser($email, $password)
{
    $this->email = htmlspecialchars($email);

    $stmt = $this->connect->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['block'] == 0) {
            if ($user) {
                
                if (md5($password) == $user['mot_de_passe']) {
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user_name"] = $user["nom"];
                    $_SESSION["user_role"] = $user["id_role"];

                    var_dump($_SESSION);
        
                    echo "<script>alert('Login successful!');</script>";
                    if ($user["id_role"] == 2) {
                        header("Location: ../views/them.php");
                    } elseif ($user["id_role"] == 1) {
                        header("Location: ../views/Dach.php");
                    }
    
                    exit;
                } else {
                    echo "<script>alert('Invalid email or password.');</script>";
                }
            } else {
                echo "<script>alert('No user found with this email.');</script>";
            }
        }else{
            echo "<script>alert('this email is band.');</script>";
        }
   
}

    }





    class User extends Person
{
    private $name;
    private $username;
    private $role;

    public function __construct()
    {
        parent::__construct(); 
    }


    public function readUser(){
        $sql = "SELECT * FROM utilisateurs";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setUser($name,$username, $email, $password)
    {
                $this->name = htmlspecialchars($name);
                $this->username = htmlspecialchars($username);
                $this->email = htmlspecialchars($email);
                $this->password = md5($password);
                    $stmt = $this->connect->prepare("INSERT INTO utilisateurs(nom, prenom , email, mot_de_passe) VALUES (?, ?, ?, ?)");
                $stmt->execute([$this->name, $this->username, $this->email, $this->password]);
                 try {
                    $stmt->execute();
                 } catch (PDOException) {
                    echo 'gfdgf';
                 }
             }
        

             public function baneUser($block, $id) {
                $sql = "UPDATE utilisateurs SET `block` = :block WHERE id = :id";
            
                $stmt = $this->connect->prepare($sql);
            
                $stmt->bindParam(':block', $block, PDO::PARAM_INT);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
                if ($stmt->execute()) {
                    echo 'User blocked successfully';
                } else {
                    echo 'Error blocking user';
                }
            }
            
    }

    class Admin extends Person{

        private $role;
    
        public function __construct($role = 1)
        {
            parent::__construct();
            
            $this->role = $role;
        }
        
        public function deletuser($id){
            $query = "DELETE FROM utilisateurs WHERE id = :id";
            $stmt = $this->connect->prepare($query);
    
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            
            if ($stmt->execute()) {
                return "Utilisateur supprimé avec succès !";
    
        }
    }

    public function statistiqueUser() {
        try {
            $query = "SELECT COUNT(*) AS total_users FROM utilisateurs WHERE id_role = 2";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_users']);
            return $result['total_users'];

        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
    }
    public function statistiqueAvis(){
        try {
            $query = "SELECT COUNT(*) AS total_evaluations FROM evaluations";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_evaluations']);
            return $result['total_evaluations'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
    }
    public function statistiqueVehicules(){
        try {
            $query = "SELECT COUNT(*) AS total_vehicules FROM vehicules";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_vehicules']);
            return $result['total_vehicules'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
    }
    public function statistiqueReservations(){
        try {
            $query = "SELECT COUNT(*) AS total_reservations FROM reservations";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_reservations']);
            return $result['total_reservations'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
    }
    }