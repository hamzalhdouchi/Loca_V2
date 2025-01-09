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


