<?php 

class Article {
    private $connect;
    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getArticle() {
        $sql = "SELECT * FROM article";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $Article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Article;
    }
    
}
