<?php
require_once __DIR__."/../config/db.php";

class categorie{

    private $connect;

    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getcategorei(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function ajoutCategorei($idCont, $postdata) {

        $sql = "INSERT INTO categories(nom, description) VALUES (:name, :description)";
    
        for ($i = 0; $i <= $idCont; $i++) {

            $name = trim($postdata["nom_$i"]);
            $description = trim($postdata["description_$i"]);
    

            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute(); 
        
        }
    }

    public function deletecategorei($id)
    {

        echo 'gfdggkgdfkf';
        try {
            $sql = "DELETE FROM categories  WHERE id_categories  = :id";
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


    public function Getmodifier($id){
        $sql = "SELECT * FROM categories  WHERE id_categories  = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function UPDATE($id,$nom,$description){

        $sql = "UPDATE categories SET nom = :nom , description = :description WHERE id_categories = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':nom',$nom,PDO::PARAM_STR);
        $stmt->bindParam(':description',$description,PDO::PARAM_STR);
       if ( $stmt->execute()) {
        echo 'dfdvvkdvkfdv';
       };
    }
    
    
}