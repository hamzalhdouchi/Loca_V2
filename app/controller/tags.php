<?php 

require_once __DIR__."/../config/db.php";
class Tags{
    private $connect;
    
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getTags(){
        $sql = "SELECT * FROM Tag";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $tag = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $tag;
    }
    public function DeleteTage($id){
        $sql = "DELETE FROM tag WHERE id = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    }
    

    public function AjouterTage($idCont, $postdata){
        $sql = "INSERT INTO tag(name) VALUES (:name)";

        for ($i = 0; $i <= $idCont; $i++) {
            $name = trim($postdata["tag_name_$i"]);
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo 'fjfkffkjdfjfjfjfjdjkjjdfdfjjdfjdfjdf';
            }else {
                echo 'rf,f';
            }
            
        
        }
     }

     public function ModiferTage($id){
        $sql = "SELECT * FROM tag WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function Modifer($id, $name) {
        $sql = "UPDATE tag SET name = :name WHERE id = :id";
    
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Assuming id is an integer
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            echo 'Update successful';
            header("Location: ../views/tagAdmiun.php");
        } else {
            echo 'Update failed';
        }
    }
    
}
