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
    
    public function Setstatus($status, $id) {
        $sql = "UPDATE article SET status = ? WHERE id = ?";
        $stmt = $this->connect->prepare($sql);  
    
        if ($stmt->execute([$status, $id])) {  
            echo 'Mise à jour réussie';
        } else {
            echo 'Échec de la mise à jour';
        }
    }
    
}
