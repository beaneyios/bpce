<?php

header("Access-Control-Allow-Origin: *");
include("Data/Services/Controllers/MySQLArticleService.php");
init();

function init() {
    
    $service = new MySQLArticleService();
    
    //hell owrrldl 
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
            $newArticle->Sharelink = $postMalone['ShareLink'];

            echo json_encode($service->create($newArticle));
            break;
        case 'PUT':
            $putDiddy = json_decode(file_get_contents('php://input'), true); 
            $article = $service->getByID($putDiddy['ID']);
            
            if (strlen($putDiddy['Headline']) != 0)
            {
                $article->Headline = $putDiddy['Headline'];
            }

            if (strlen($putDiddy['Subheadline']) != 0)
            {
                $article->Subheadline = $putDiddy['Subheadline'];    
            }
            
            if (strlen($putDiddy['ShareLink']) != 0)
            {
                $article->Sharelink = $putDiddy['ShareLink'];
            }
            
            echo json_encode($service->update($article));
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