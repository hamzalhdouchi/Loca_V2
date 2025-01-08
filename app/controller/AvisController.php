

<?php

require __DIR__."/../config/db.php";

class avis{
    private $connect;
    public function __construct(){
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getavis(){
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN evaluations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules;
                ";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAVG($idA){
        
        $sql = "SELECT AVG(note) AS average_rating
                FROM evaluations WHERE vehicule_id = :id";
                
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$idA);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_rating'];
    }

    public function SetAvis($idU,$idV,$note,$comment){
        $sql = "INSERT INTO evaluations(client_id,vehicule_id ,note,comment) VALUES (:idU,:idV,:note,:comment)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':idU',$idU);
        $stmt->bindParam(':idV',$idV);
        $stmt->bindParam(':note',$note);
        $stmt->bindParam(':comment',$comment);
        $stmt->execute();
    }
}