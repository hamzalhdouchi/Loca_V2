<?php 
require_once __DIR__."/../config/db.php";
class comment{
    private $connect;

    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }
}
