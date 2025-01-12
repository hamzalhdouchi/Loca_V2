<?php 

require_once __DIR__."/../config/db.php";

class Favorite {
    private $connect;
    private $status;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = (int) $status;  
    }

    public function getLike($idA, $idU) {
        $sql = 'SELECT * FROM favorite WHERE article_id = :id_article AND client_id = :id_User';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id_article', $idA, PDO::PARAM_INT);
        $stmt->bindParam(':id_User', $idU, PDO::PARAM_INT);
        $stmt->execute();
        $likes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $likes;
    }

    public function likeSet($id_user, $id_Article, $like) {
        $this->setStatus($like);  
        $sql = "INSERT INTO favorite(article_id, client_id, favorite) VALUES (:article_id, :client_id, :favorite)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':article_id', $id_Article, PDO::PARAM_INT);
        $stmt->bindParam(':client_id', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':favorite', $this->getStatus(), PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../views/articleditels.php?id=$id_Article");
        exit();
    }


    public function deleteLike($id, $id_Article) {
        $sql = "DELETE FROM favorite WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            
        }

        header("Location: ../views/articleditels.php?id=$id_Article");
        exit();
    }

    public function AddToFavourait($favorite ,$idu ,$idA){
        $sql = $sql = "INSERT INTO  leslike(valeur, id_artecle ,id_clent) VALUES (:addFavourait, :article, :client)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':article', $idA, PDO::PARAM_INT);
        $stmt->bindParam(':client', $idu, PDO::PARAM_INT);
        $stmt->bindParam(':addFavourait', $favorite, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function getFavorait($idA,$idU){
        $sql = 'SELECT * FROM leslike WHERE  id_artecle = :id_article AND id_clent  = :id_User';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id_article', $idA, PDO::PARAM_INT);
        $stmt->bindParam(':id_User', $idU, PDO::PARAM_INT);
        $stmt->execute();
        $likes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $likes;
    }
    
}
?>
