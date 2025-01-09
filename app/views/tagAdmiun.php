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

