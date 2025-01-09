<?php
require __DIR__ . "/../controller/Article.php";
require __DIR__."/../controller/comment.php";
require __DIR__."/../controller/favorait.php";
session_start();

$idU = $_SESSION['user_id'];
$coment = new comment();

$idA = $_GET['id'];

$comment = $coment->getComment($idA);

$article = new Article();
$articles = $article->getArticleSpiciale($idA);
$SpicialArticle = $articles[0];
