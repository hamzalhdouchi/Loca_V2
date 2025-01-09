<?php 

require_once __DIR__."/../config/db.php";

class Favorite {
    private $connect;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getDatabase();
    }
    public function getLike($idA, $idU) {
        $sql = 'SELECT * FROM favorite WHERE article_id = :id_article AND client_id = :id_User';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id_article', $idA);
        $stmt->bindParam(':id_User', $idU);
        $stmt->execute();
        $likes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $likes;
    }

}
