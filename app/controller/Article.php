<?php 

class Article {
    private $connect;
    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }
}
