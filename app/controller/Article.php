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
    public function getArticleWithTags($limit, $offset) {
        $sql = "
           SELECT 
                article.*, 
                GROUP_CONCAT(tag.name) AS tags
            FROM 
                article
            LEFT JOIN 
                articletag ON article.id = articletag.article_id
            LEFT JOIN 
                tag ON articletag.tag_id = tag.id
            GROUP BY 
                article.id 
            LIMIT :limit OFFSET :offset";
            
        $stmt = $this->connect->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }
    public function setArticle($idT, $title, $content, $image, $tags) {
        if (isset($image) && $image['error'] === 0) {
            $uploadDir = '../views/assets/img/';
            $uploadFile = $uploadDir . basename($image['name']);
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($image['type'], $allowedTypes)) {
                if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                }
            }
        }
    }    
}
