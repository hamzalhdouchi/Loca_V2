<?php 

require_once __DIR__."/../config/db.php";

class themes{
    private $connect;
    
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getTemes(){
        $sql = "SELECT * FROM theme";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $themes;
    }

    public function DeletTemes($id){
        $sql = "DELETE FROM theme WHERE id = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    }
     public function AjouterTheme($idCont, $postdata){
        $sql = "INSERT INTO theme(name, description,created_Date) VALUES (:name,:description,:date)";
    
        for ($i = 0; $i <= $idCont; $i++) {

            $name = trim($postdata["name_$i"]);
            $description = trim($postdata["description_$i"]);
            $date = trim($postdata["created_date_$i"]);
    

            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo 'fjfkffkjdfjfjfjfjdjkjjdfdfjjdfjdfjdf';
            }else {
                echo 'rf,f';
            }
            
        
        }
     }
    public function ModiferTheme($id){
        $sql = "SELECT * FROM theme WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function Modifer($id,$name,$description,$date){
            $sql = "UPDATE theme SET name = :name , description = :description , created_date = :date   WHERE id = :id";
    
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR); 
            $stmt->execute();
        }   
}
