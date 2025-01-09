<?php 

require_once __DIR__."/../config/db.php";

class themes{
    private $connect;
    
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }
}
