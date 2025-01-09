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
<section class="relative bg-blue-900 text-white h-96">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <img src="./public/img/gallery/2.jpg" alt="Electric Car" class="w-full h-full object-cover">
    <div class="absolute inset-0 flex items-center justify-center text-center px-6">
        <div>
            <h2 class="text-4xl font-bold mb-4">Welcome to the Future of Cars</h2>
            <p class="text-lg mb-6">Explore the latest innovations, reviews, and trends in the automotive world.</p>
        </div>
    </div>
</section>

<div id="article-details" class=" bg-white rounded-lg shadow-lg mt-6 p-6">
    <h2 class="text-3xl font-semibold text-gray-900 mb-4"><?= $SpicialArticle['title'] ?></h2>
    <p class="text-gray-600 mb-4"><?= $SpicialArticle['content'] ?></p>
</div>

