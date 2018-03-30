<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLArticleService
 *
 * @author Matt
 */

include("Article.php");
include("ArticleServiceInterface.php");

class MySQLArticleService implements ArticleInterface {
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=news;charset=utf8mb4', '', '');
    }
            
    public function create($article) {
        $sql = "INSERT INTO `articleindex` (`Headline`, `Subheadline`, `ShareLink`) VALUES (:headline, :subheadline, :sharelink)";
 
        //Prepare our statement.
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':headline', $article->Headline);
        $statement->bindValue(':subheadline', $article->Subheadline);
        $statement->bindValue(':sharelink', $article->Sharelink);

        //Execute the statement and insert our values.
        try {
            $inserted = $statement->execute();
        } catch(PDOException $ex) {
            return null;
        }
        
        if($inserted) {
            $article->ID = $this->db->lastInsertID();
            return $article;
        } else {
            return null;
        }
    }

    public function delete($article) {
        
    }

    public function get() {
        $stmt = $this->db->query("SELECT * FROM articleindex");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $objArticles = array();
   
        try {
            foreach($results as $item) {
                $objArticle = new Article();
                $objArticle->ID = $item['ID'];
                $objArticle->Headline = $item['Headline'];
                $objArticle->Subheadline = $item['Subheadline'];
                $objArticle->Sharelink = $item["ShareLink"];
                array_push($objArticles, $objArticle);
            }
            
            return $objArticles;
        } catch(PDOException $ex) {
            return array();
        }
    }

    public function update($article) {
        
    }

}
