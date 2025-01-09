<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/themes.php";

$themes = new themes();
$result = $themes->getTemes();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['supprimer'])) {
    $id = intval($_POST['supprimerV']);
    $themes->DeletTemes($id);
}
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['AjouterTheme'])) {
    $cont = $_POST['cont'];
    $themes->AjouterTheme($cont, $_POST);
}
?>
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
                <li><a href="./themeAdmin.php" class="active"><span class="las la-tasks"></span><small>Theme</small></a></li>
                <li><a href="./ArticleAdmin.php"><span class="las la-newspaper"></span><small>Article</small></a></li>
                <li><a href="./tagAdmiun.php"><span class="las la-tag"></span><small>Tag</small></a></li>
            </ul>
        </div>
    </div>
</div>


