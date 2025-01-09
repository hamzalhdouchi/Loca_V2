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

