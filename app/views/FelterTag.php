<?php
require __DIR__."/../controller/Article.php";
if (isset($_GET['tag']) && !empty($_GET['tag'])) {
    $tagId = intval($_GET['tag']);
    $articleClass = new Article();

    $result = $articleClass->filter($tagId);

    echo json_encode($result);
}

