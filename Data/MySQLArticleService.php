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
include("PDOManager.php");

class MySQLArticleService implements ArticleInterface {
    //DB details
    private $db;
    
    //Table details
    private $tableName = "`articleindex`";
    private $colHeadline = "`Headline`";
    private $colSubheadline = "`Subheadline`";
    private $colSharelink = "`ShareLink`";
    
    public function __construct() {
        $this->db = PostGresPDOManager::PDO();
    }
            
    public function create($article) {
        $columns = "".$this->tableName." (".$this->colHeadline.", ".$this->colSubheadline.", ".$this->colSharelink.")";
        $values  = "(:headline, :subheadline, :sharelink)";
        $sql = "INSERT INTO ".$columns." VALUES ".$values;
 
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
        try {
            $stmt = $this->db->query("SELECT * FROM articleindex");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $objArticles = array();
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
