<?php

require __DIR__."/../controller/Article.php";

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);  
    $articleClass = new Article();

    
    $result = $articleClass->search($query);
    
    echo json_encode($result); 
} else {
    echo json_encode([]);  
}
?>
