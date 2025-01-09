<?php
require __DIR__ . "/../controller/Article.php";
require __DIR__ . "/../controller/tags.php";

$tag = new Tags();
$tags = $tag->getTags();
var_dump($tags);

$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

$limit = $itemsPerPage;
$offset = ($currentPage - 1) * $itemsPerPage;
$article = new Article();
$articles = $article->getArticleWithTags($limit, $offset);

$totalArticles = $article->countArticle(); 
$totalPages = ceil($totalArticles / $itemsPerPage);

?>
