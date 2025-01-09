<?php 
session_start();
$user = $_SESSION['user_name'];
require __DIR__."/../controller/themes.php";

$themes = new themes();

$theme = $themes->getTemes();
?>
