<?php 

require_once __DIR__."/../config/db.php";

class Reservation {
    private $connect;
    private $dateReservation;
    private $adresseLivraison;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getDateReservation() {
        return $this->dateReservation;
    }

    public function setDateReservation($dateReservation) {
        $this->dateReservation = $dateReservation;
    }

    public function getAdresseLivraison() {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison($adresseLivraison) {
        $this->adresseLivraison = $adresseLivraison;
    }

    public function getReservation() {
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN reservations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules;";
        
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReservationUser($id) {
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN reservations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules WHERE u.id = :id;";
        
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setStatus($status, $id) {
        $sql = "UPDATE reservations SET status = :status WHERE id_reservation = :id";
        $stmt = $this->connect->prepare($sql);

        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        header("Location: ../views/ReservationAdmin.php");
        exit;
        return 'Mise à jour réussie';
       
    }

    public function ajouterReservation($client_id, $vehicule_id) {
        $sql = "INSERT INTO reservations(client_id, vehicule_id, date_reservation, adresse) 
                VALUES (:client_id, :vehicule_id, :date_reservation, :adresse)";
        
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $stmt->bindParam(':vehicule_id', $vehicule_id, PDO::PARAM_INT);
        $stmt->bindParam(':date_reservation', $this->dateReservation, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $this->adresseLivraison, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'Réservation ajoutée avec succès';
        } else {
            return 'Erreur lors de l\'ajout de la réservation';
        }
    }

    public function Annule($idR){
        $sql = "DELETE FROM reservations WHERE id_reservation  = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id' , $idR,PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../views/reservation.php");
        exit;
    }
}

?>
