<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/Article.php";
?>
