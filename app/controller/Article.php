<?php
require_once __DIR__ . "/../config/db.php";

class Article
{
    private $connect;
    private $title;
    private $content;
    private $tags;
    private $images;

    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }
 
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getArticle(){
        $sql = "SELECT * FROM article";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $Article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Article;
    }

    public function getArtecleForpag($idT){
        $sql = "SELECT * FROM article WHERE theme_id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $idT, PDO::PARAM_INT);
        $stmt->execute();

        $Article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Article;
    }

    public function Setstatus($status,$id){
        
        $sql = "UPDATE article SET status = ? WHERE id = ?";
        $stmt = $this->connect->prepare($sql);  
    
        
        if ($stmt->execute([$status, $id])) {  
            echo 'Mise à jour réussie';
            header("Location: ../views/ArticleAdmin.php");
            exit();
        } else {
            echo 'Échec de la mise à jour';
        }
    }

    public function getArticleWithTags($limit, $offset,$idT) {
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
                WHERE theme_id  = :idT
            GROUP BY 
                article.id 
            LIMIT :limit OFFSET :offset";
            
        $stmt = $this->connect->prepare($sql); // Removed duplicate line
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':idT', $idT, PDO::PARAM_INT);
        $stmt->execute();
        
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }
    

    public function setArticle($idT ,$title ,$content,$tags,$image)
    {
        $this->setTitle($title);
    $this->setContent($content);
    $this->setTags($tags);
    $this->setImages($image);
        if (isset($this->images) && $this->images['error'] === 0) {
            

            $uploadDir = '../views/assets/img/';
            $uploadFile = $uploadDir . basename($this->images['name']);

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($this->images['type'], $allowedTypes)) {
                if (move_uploaded_file($this->images['tmp_name'], $uploadFile)) {
                    $sql = "INSERT INTO article (title, content, theme_id, images) VALUES (:title, :content, :idT, :image)";
                    $stmt = $this->connect->prepare($sql);
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':content', $this->content);
                    $stmt->bindParam(':idT', $idT);
                    $stmt->bindParam(':image', $uploadFile);
                    $stmt->execute();

                    $articleId = $this->connect->lastInsertId();
                    var_dump($this->tags);
                    $this->tags = explode(',', $this->tags);
                    foreach ($this->tags as $tag) {
                        $sql = "INSERT INTO articletag (article_id, tag_id) VALUES (:article_id, :tag_id)";
                        $stmt = $this->connect->prepare($sql);
                        $stmt->bindParam(':article_id', $articleId);
                        $stmt->bindParam(':tag_id', $tag);
                        if ($stmt->execute()) {
                            echo "<script>alert('Article ajouter avec sucsses');</script>";
                            header("Location: ../views/artecl.php?id=$idT");
                            exit();
                        };
                       
                    }

                   
                } else {
                    echo "Failed to upload the image.";
                }
            } else {
                echo "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
            }
        } else {
            echo "No valid image provided.";
        }
    }

    public function getArticleSpiciale($idA) {
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
            WHERE 
                article.id = :id
            GROUP BY 
                article.id;
        ";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $idA, PDO::PARAM_INT);
        $stmt->execute();
    
        $Article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Article;
    }

    public function getArticleALL() {
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
                article.id;
        ";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    
        $Article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Article;
    }
    
    public function countArticle() {
        $sql = "SELECT COUNT(*) as total FROM article";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

  
    public function filter($tagId) {
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
            WHERE 
                articletag.tag_id = :tagId
            GROUP BY 
                article.id;
        ";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
        $stmt->execute();

        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    public function search($query) {
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
        WHERE 
            article.title LIKE :query OR article.content LIKE :query
        GROUP BY 
            article.id;
        ";
        
        $stmt = $this->connect->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesWithLikes($id) {
        $sql = "
            SELECT 
                article.id AS article_id,
                article.title,
                article.content,
                GROUP_CONCAT(tag.name) AS tags,
                leslike.*
            FROM 
                article
            LEFT JOIN 
                articletag ON article.id = articletag.article_id
            LEFT JOIN 
                tag ON articletag.tag_id = tag.id
            LEFT JOIN 
                leslike ON article.id = leslike.id_artecle
            WHERE 
                leslike.id_clent = :id
            GROUP BY 
                article.id, leslike.id_like, leslike.id_clent
        ";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $articlesWithLikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articlesWithLikes;
    }
    
}

