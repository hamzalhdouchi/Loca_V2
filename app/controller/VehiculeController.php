<?php

require_once __DIR__."/../config/db.php";
class vehicule
    {

    private $modele;
    private $image;
    private $prix;
    private $description;
    private $disponibilite;
    private $connect;


    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    
    public function getVehiculee() {
        $sql = "SELECT * 
                FROM vehicules 
                INNER JOIN categories 
                    ON vehicules.categorie_id = categories.id_categories 
                INNER JOIN evaluations 
                    ON evaluations.vehicule_id = vehicules.id_vehicules";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getVehicule($limit, $offset) {
        $sql = "SELECT * 
                FROM vehicules 
                INNER JOIN categories 
                    ON vehicules.categorie_id = categories.id_categories 
                INNER JOIN evaluations 
                    ON evaluations.vehicule_id = vehicules.id_vehicules 
                LIMIT :limit OFFSET :offset";
    
        $stmt = $this->connect->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function countVehicules() {
        $sql = "SELECT COUNT(*) as total FROM vehicules";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    

    public function Setdisponible($despo,$id){
        
        $sql = "UPDATE vehicules SET disponibilite = ? WHERE id_vehicules = ?";
        $stmt = $this->connect->prepare($sql);  
    
        
        if ($stmt->execute([$despo, $id])) {  
            echo 'Mise à jour réussie';
        } else {
            echo 'Échec de la mise à jour';
        }
    }

    public function deletevehicules($id)
    {
        try {
            $sql = "DELETE FROM vehicules WHERE id_vehicules = :id";
            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "Ville supprimée avec succès !";
            }else{
                echo 'gnfdjggjkg';
            }
        } catch (PDOException) {
            return "Erreur  ";
        }
    }

    function AjouteMulti($idCount, $postData, $fileData) {
        $categorie = $postData['categorie_id'];
        $sql = "INSERT INTO vehicules (modele, description, prix, disponibilite, image, categorie_id) 
                VALUES (:model, :description, :prix, :disponibilite, :image, :categorie_id)";
        
        for ($i = 0; $i <= $idCount; $i++) {
            $model = trim($postData["model_$i"]);
            $disponibilite = trim($postData["disponibilite_$i"]);
            $description = trim($postData["description_$i"]);
            $prix = trim($postData["prix_$i"]);
            $imageFile = $fileData["image_$i"];
            
            
            if ($imageFile['error'] === 0) {
                $imageName = $imageFile['name'];
                $imageTmpName = $imageFile['tmp_name'];
                $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                $uniqueName = uniqid('img_', true) . '.' . $imageExt;
                $uploadPath = '../views/assets/img/' . $uniqueName;
    
                if (move_uploaded_file($imageTmpName, $uploadPath)) {
                    $stmt = $this->connect->prepare($sql);
                    $stmt->bindParam(':model', $model, PDO::PARAM_STR);
                    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                    $stmt->bindParam(':prix', $prix, PDO::PARAM_STR); 
                    $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_INT);
                    $stmt->bindParam(':image', $uniqueName, PDO::PARAM_STR);
                    $stmt->bindParam(':categorie_id', $categorie, PDO::PARAM_INT);
    
                    $stmt->execute();
                }
            }
        }
    }
    
    public function UPDATEVehucule($id){
        $sql = "SELECT * FROM vehicules  WHERE  id_vehicules = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function ModifierVéhicule($id,$model,$description,$prix,$disponibilite,$categorie){
        $sql = "UPDATE vehicules SET modele = :model , description = :description , prix = :prix , disponibilite = :disponibilite ,categorie_id = :categorie_id  WHERE id_vehicules = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_STR); 
        $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_INT);
        $stmt->bindParam(':categorie_id', $categorie, PDO::PARAM_INT);

        $stmt->execute();
    }   
    public function getSPisailVehicule($id){
        $sql = "SELECT * FROM vehicules WHERE  id_vehicules = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function search($search){
        $sql = "SELECT * FROM vehicules WHERE LOWER(modele) = LOWER(:modele)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':modele',$search);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function afficherVoitureCategorie(){
        $stmt = $this->connect->prepare("SELECT * from vehicules");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}