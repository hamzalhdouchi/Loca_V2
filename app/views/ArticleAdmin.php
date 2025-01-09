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


