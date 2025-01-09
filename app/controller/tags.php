<?php 

require_once __DIR__."/../config/db.php";

class Tags {
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
    
}

