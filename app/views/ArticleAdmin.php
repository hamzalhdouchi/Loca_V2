<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/Article.php";

<?php
$themes = new Article();

$result = $themes->getArticle();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['stat'];
    
    $themes->Setstatus($status, $id);
}
?>

?>
