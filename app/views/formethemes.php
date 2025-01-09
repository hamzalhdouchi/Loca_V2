<?php 
require __DIR__."/../controller/themes.php";
$idT = $_GET['id_M'];
$themes = new themes();
$result = $themes->ModiferTheme($idT);
?>

?>
