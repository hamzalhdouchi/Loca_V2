<?php
require_once __DIR__ . "/../config/db.php";

class Categorie {
    private $connect;
    private $nomCategorie;
    private $description;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getNomCategorie() {
        return $this->nomCategorie;
    }

    public function setNomCategorie($nomCategorie) {
        $this->nomCategorie = htmlspecialchars($nomCategorie);
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = htmlspecialchars(trim($description));
    }

    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function ajoutCategorie($idCont, $postdata) {
        $sql = "INSERT INTO categories(nom, description) VALUES (:name, :description)";
        for ($i = 0; $i <= $idCont; $i++) {
            $name = $postdata["nom_$i"];
            $description = $postdata["description_$i"];

            $this->setNomCategorie($name);
            $this->setDescription($description);

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':name', $this->nomCategorie, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->execute();
        }

    }

    public function deleteCategorie($id) {
        try {
            $sql = "DELETE FROM categories WHERE id_categories = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
               
                header("Location: ../views/categorei.php");
                exit;
           
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getModifier($id) {
        $sql = "SELECT * FROM categories WHERE id_categories = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $nom, $description) {
        $sql = "UPDATE categories SET nom = :nom, description = :description WHERE id_categories = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        if ($stmt->execute()) {
            header("Location: ../views/categorei.php");
            exit;
        } else {
            return "Erreur lors de la mise à jour.";
        }
    }
}
?>
