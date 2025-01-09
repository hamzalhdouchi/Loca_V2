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
