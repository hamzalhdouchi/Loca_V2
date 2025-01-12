<?php 

require_once __DIR__."/../config/db.php";
class Tags{
    private $connect;
    private $name;
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

        public function getName(){
        return $this->name;
    }


    public function setName($name){
        $this->name = $name;
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
        header("Location: ../views/tagAdmiun.php");
        exit;
    }
    

    public function AjouterTage($idCont, $postdata){
        $sql = "INSERT INTO tag(name) VALUES (:nameS)";

        for ($i = 0; $i <= $idCont; $i++) {
            $name = trim($postdata["tag_name_$i"]);
            $this->setName($name);
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':nameS', $this->name, PDO::PARAM_STR);
            $stmt->execute();
        
        }
        header("Location: ../views/tagAdmiun.php");
        exit;
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
