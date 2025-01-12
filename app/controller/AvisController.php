<?php

require __DIR__ . "/../config/db.php";

class Avis {
    private $connect;
    private $note;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    // Getter pour la propriété note
    public function getNote() {
        return $this->note;
    }

    // Setter pour la propriété note
    public function setNote($note) {
            $this->note = $note;
    }

    public function getAvis() {
        $sql = "SELECT *
                FROM utilisateurs u
                JOIN evaluations r ON u.id = r.client_id
                JOIN vehicules v ON r.vehicule_id = v.id_vehicules";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAVG($idA) {
        $sql = "SELECT AVG(note) AS average_rating
                FROM evaluations
                WHERE vehicule_id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $idA, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_rating'] ?? null; 
    }

    public function setAvis($idU, $idV,$note,$comment) {
        $this->setNote($note);
        $sql = "INSERT INTO evaluations(client_id, vehicule_id, note, comment) 
                VALUES (:idU, :idV, :note, :comment)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':idU', $idU, PDO::PARAM_INT);
        $stmt->bindParam(':idV', $idV, PDO::PARAM_INT);
        $stmt->bindParam(':note', $this->note, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
    }
}
