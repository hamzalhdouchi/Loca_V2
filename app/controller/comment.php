<?php 
require_once __DIR__."/../config/db.php";
class comment{
    private $connect;

    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getComment($id){
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
    

    public function setComment($comment, $idU, $idA){
        $sql = "INSERT INTO comment(content, author_id, article_id) VALUES (:comment, :idUser, :idArticle)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':idUser', $idU);
        $stmt->bindParam(':idArticle', $idA);
        $stmt->execute();
        
        header("Location: ../views/articleditels.php?id=$idA");
        exit();
    }
    
}
