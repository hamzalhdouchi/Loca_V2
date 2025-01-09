<?php 

require_once __DIR__."/../config/db.php";
class favorite{
    private $connect;
    
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function getLike($idA,$idU){
        $sql = 'SELECT * FROM favorite WHERE article_id = :id_article AND client_id = :id_User';
        $stmt= $this->connect->prepare($sql);
        $stmt->bindParam(':id_article' ,$idA);
        $stmt->bindParam(':id_User' ,$idU);
        $stmt->execute();
        $likes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $likes;
    }

    public function likeSet($id_user,$id_Article,$like){
        $sql = "INSERT INTO favorite(article_id ,client_id ,favorite) VALUES (:article_id,:client_id,:favorite)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':article_id',$id_Article , PDO::PARAM_INT);
        $stmt->bindParam(':client_id',$id_user,PDO::PARAM_INT);
        $stmt->bindParam(':favorite',$like , PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../views/articleditels.php?id=$id_Article");
        exit();

    } public function deletLike($id,$id_Article){
        $sql = "DELETE FROM favorite WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            var_dump('gjgfkjd jfrjk fd kj');
        }
        header("Location: ../views/articleditels.php?id=$id_Article");
        exit();

    }
}