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

$favorite = new favorite();
$likes = $favorite->getLike($idA,$idU);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PostComment'])) {
    $comment = htmlspecialchars($_POST['comment']);
    $idA = intval($_POST['idA']);
    $idU = intval($_POST['idU']);
    $coment->setComment($comment,$idU,$idA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['likeButton'])) {
    $like = intval($_POST['like']);
    $idA = intval($_POST['id_Article']);
    $idU = intval($_POST['id_user']);
    $favorite->likeSet($idU,$idA,$like);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletLike'])) {
    $like = intval($_POST['likess']);
    $idA = intval($_POST['id_Article']);
    $favorite->deletLike($like,$idA);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-50">
