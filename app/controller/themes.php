<?php 

require_once __DIR__."/../config/db.php";

class Themes {
    private $connect;
    private $name;
    private $description;
    private $dateDeCreation;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDateDeCreation() {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation($date) {
        $this->dateDeCreation = $date;
    }

    public function getThemes() {
        $sql = "SELECT * FROM theme";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTheme($id) {
        $sql = "DELETE FROM theme WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../views/themeAdmin.php");
        exit();
    }

    public function addTheme($idCont, $postdata) {
        $sql = "INSERT INTO theme(name, description, created_date) VALUES (:name, :description, :date)";
    
        for ($i = 0; $i <= $idCont; $i++) {
            $name = trim($postdata["name_$i"]);
            $description = trim($postdata["description_$i"]);
            $date = trim($postdata["created_date_$i"]);

            $this->setName($name);
            $this->setDescription($description);
            $this->setDateDeCreation($date);
    
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':date', $this->dateDeCreation, PDO::PARAM_STR);
    
            if (!$stmt->execute()) {
                echo 'Erreur lors de l ajout du thème';
            }
        }
        header("Location: ../views/tagAdmiun.php");
        exit;
    }

    public function getThemeById($id) {
        $sql = "SELECT * FROM theme WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTheme($id, $name, $description, $date) {
        $sql = "UPDATE theme SET name = :name, description = :description, created_date = :date WHERE id = :id";

        $this->setName($name);
        $this->setDescription($description);
        $this->setDateDeCreation($date);

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':date', $this->dateDeCreation, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            echo 'Mise à jour réussie';
            header("Location: ../views/themeAdmin.php");
            exit();
        } else {
            echo 'Échec de la mise à jour';
        }
    }
}
?>
