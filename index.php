<?php

include("Data/MySQLArticleService.php");

$service = new MySQLArticleService();

$newArticle;

foreach($service->get() as $article) {
    $newArticle = $article;
}


echo $service->create($newArticle);
 
?>