<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/tags.php";

$themes = new Tags();

$result = $themes->getTags();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['supprimer'])) {
    $id = intval($_POST['supprimerV']);
    $themes->DeleteTage($id);
}

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['submitTag'])) {
    $cont = $_POST['id'];
    $themes->AjouterTage($cont, $_POST);
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
                    <li><a href="./ArticleAdmin.php"><span class="las la-newspaper"></span><small>Article</small></a></li>
                    <li><a href="./tagAdmiun.php" class="active"><span class="las la-tag"></span><small>Tag</small></a></li>
                </ul>
            </div>
        </div>
    </div>

