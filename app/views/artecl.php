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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_car_theme'])) {
    $idt = intval($_POST['idT']);
    $title = htmlspecialchars($_POST['car_title']);
    $content = htmlspecialchars($_POST['car_content']);
    $tags = $_POST['car_tags'];

    $image = $_FILES['car_image'];
    $article->setArticle($idt, $title, $content, $image, $tags);
}

?>
