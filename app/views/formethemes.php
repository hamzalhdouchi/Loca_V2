<?php 
require __DIR__."/../controller/themes.php";
$idT = $_GET['id_M'];
$themes = new themes();
$result = $themes->ModiferTheme($idT);
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['ModifierTheme'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['created_date']);
    $idT = intval($_POST['id_T']);
    $themes->Modifer($idT, $name, $description, $date);
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
<div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 z-50">

