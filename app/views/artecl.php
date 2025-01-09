<?php
require __DIR__ . "/../controller/Article.php";
require __DIR__ . "/../controller/tags.php";

$tag = new Tags();
$tags = $tag->getTags();
var_dump($tags);

?>
