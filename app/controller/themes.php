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
    
}
