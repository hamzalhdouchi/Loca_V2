<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/Article.php";

$themes = new Article();

$result = $themes->getArticle();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['stat'];
    
    $themes->Setstatus($status, $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/css/css/dach.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>odern</span></h3>
        </div>
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                <h4><?= $userName ?></h4>
                <small>Director</small>
            </div>
            <div class="side-menu">
                <ul>
                    <li><a href="./Dach.php"><span class="las la-user-alt"></span><small>users</small></a></li>
                    <li><a href="./categorei.php"><span class="las la-th-large"></span><small>categorei</small></a></li>
                    <li><a href="./vehcule.php"><span class="las la-car"></span><small>véhcule</small></a></li>
                    <li><a href="./reservationAdmin.php"><span class="las la-clipboard-check"></span><small>reservation</small></a></li>
                    <li><a href="./evaluations.php"><span class="las la-star"></span><small>Avis</small></a></li>
                    <li><a href="./themeAdmin.php"><span class="las la-tasks"></span><small>Theme</small></a></li>
                    <li><a href="./ArticleAdmin.php" class="active"><span class="las la-newspaper"></span><small>Article</small></a></li>
                    <li><a href="./tagAdmiun.php"><span class="las la-tag"></span><small>Tag</small></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle"><span class="las la-bars"></span></label>
                <div class="header-menu">
                    <label for=""><span class="las la-search"></span></label>
                    <div class="notify-icon"><span class="las la-envelope"></span><span class="notify">4</span></div>
                    <div class="notify-icon"><span class="las la-bell"></span><span class="notify">3</span></div>
                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                        <span class="las la-power-off"></span>
                        <span><a href="./register.php">Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle"><span class="las la-bars"></span></label>
                <div class="header-menu">
                    <label for=""><span class="las la-search"></span></label>
                    <div class="notify-icon"><span class="las la-envelope"></span><span class="notify">4</span></div>
                    <div class="notify-icon"><span class="las la-bell"></span><span class="notify">3</span></div>
                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                        <span class="las la-power-off"></span>
                        <span><a href="./register.php">Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
        <div class="page-content">
            <div class="records table-responsive">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><span class="las la-sort"></span> name</th>
                            <th><span class="las la-sort"></span> discrption</th>
                            <th><span class="las la-sort"></span>Date de creation</th>
                            <th><span class="las la-sort"></span> ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>



