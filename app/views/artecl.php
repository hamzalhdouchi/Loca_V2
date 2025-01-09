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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-50">

<header class="bg-blue-900 text-white py-3 px-6 shadow-md">
    <div class="flex items-center justify-between">
        <a href="./index.php" class="flex items-center">
            <i class="fas fa-car-side text-2xl text-white mr-2"></i>
            <h1 class="text-2xl font-bold tracking-wide">Car Blog</h1>
        </a>
        <nav class="flex items-center space-x-6 text-sm font-medium">
            <a href="./them.php" class="hover:text-yellow-400">Themes</a>
            <a href="#about" class="hover:text-yellow-400">About</a>
            <a href="#contact" class="hover:text-yellow-400">Contact</a>
        </nav>
        <a href="./inde.php" class="bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg">Explore Cars</a>
    </div>
</header>
<section class="relative bg-blue-900 text-white h-96">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <img src="./public/img/gallery/3.jpg" alt="Electric Car" class="w-full h-full object-cover">
    <div class="absolute inset-0 flex items-center justify-center text-center px-6">
        <div>
            <h2 class="text-4xl font-bold mb-4">Welcome to the Future of Cars</h2>
            <p class="text-lg mb-6">
                Explore the latest innovations, reviews, and trends in the automotive world.
            </p>
            <button onclick="openModalBtn()" class="bg-yellow-500 text-blue-900 font-semibold py-2 px-6">Explore Articles</button>
        </div>
    </div>
</section>


