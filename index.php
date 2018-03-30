<?php

include("Data/MySQLArticleService.php");
init();

function init() {
    $service = new MySQLArticleService();
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            echo json_encode($service->get());
            break;
        case 'POST':
            $postMalone = json_decode(file_get_contents('php://input'), true);
            
            $newArticle = new Article();
            $newArticle->Headline = $postMalone['Headline'];
            $newArticle->Subheadline = $postMalone['Subheadline'];
            $newArticle->ShareLink = $postMalone['ShareLink'];

            echo $service->create($newArticle);
            break;
        case 'PUT':
            echo 'put';
            break;
        case 'DELETE':
            echo 'delete';
            break;
        default:
            echo 'default';
            break;
    }
}

?>