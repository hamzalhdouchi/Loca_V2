<?php 
require_once __DIR__."/../config/db.php";

class Comment {
    private $connect;
    private $content;

    public function __construct() {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = htmlspecialchars(trim($content));  
    }

    public function getComment($id) {
        $sql = " 
            SELECT * 
            FROM comment 
            JOIN utilisateurs 
            ON comment.author_id = utilisateurs.id 
            WHERE article_id = :id;";
    
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $comment;
    }

    public function setComment($content, $idU, $idA) {
        $this->setContent($content); 

        $sql = "INSERT INTO comment(content, author_id, article_id) VALUES (:comment, :idUser, :idArticle)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':comment', $this->getContent());
        $stmt->bindParam(':idUser', $idU);
        $stmt->bindParam(':idArticle', $idA);
        $stmt->execute();

        header("Location: ../views/articleditels.php?id=$idA");
        exit();
    }

    public function DeleteComent($id,$idA){
        $sql = "DELETE FROM comment WHERE id_comment = :id";

        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        header("Location: ../views/articleditels.php?id=$idA");
        exit();
    }
    public function ModiferComment($id){
        $sql = "SELECT * FROM comment WHERE id_comment = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function Modifer($id, $comment) {
        $sql = "UPDATE comment SET content = :content WHERE id_comment = :id";
    
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Assuming id is an integer
        $stmt->bindParam(':content', $comment, PDO::PARAM_STR);
    
        $stmt->execute();
        
    }
}
?>
