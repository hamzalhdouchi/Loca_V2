<?php 

require_once __DIR__."/../config/db.php";

class reservation
    {
    private $connect;
    public function __construct(){
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getReservation(){
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN reservations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules;
                ";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReservationUSER($id){
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN reservations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules WHERE id = :id;
                ";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function Setstatus($status,$id){
        
        $sql = "UPDATE reservations SET status = ? WHERE id_reservation = ?";
        $stmt = $this->connect->prepare($sql);  
    
        
        if ($stmt->execute([$status, $id])) {  
            echo 'Mise à jour réussie';
        } else {
            echo 'Échec de la mise à jour';
        }
    }




    public function AjouterReservation($client_id,$vehicule_id,$date_reservation,$adresse ){

        $sql = "INSERT INTO reservations(client_id, vehicule_id, date_reservation, adresse) 
                VALUES (:client_id, :vehicule_id, :date_reservation, :adresse)";

                $stmt = $this->connect->prepare($sql);
                $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
                $stmt->bindParam(':vehicule_id', $vehicule_id, PDO::PARAM_INT);
                $stmt->bindParam(':date_reservation', $date_reservation, PDO::PARAM_STR); 
                $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo 'ajouter is sucsse';
                }else{
                    echo 'frnggn';
                }
    }


    
}               