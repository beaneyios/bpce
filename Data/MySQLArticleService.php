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
        $columns = " (`ID`, ".$this->colHeadline.", ".$this->colSubheadline.", ".$this->colSharelink.")";
        $values  = "(:ID, :headline, :subheadline, :sharelink)";
        $sql = "INSERT INTO ".$this->tableName." ".$columns." VALUES ".$values;
        echo $sql;
 
        //Prepare our statement.
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':ID', 1);
        $statement->bindValue(':headline', $article->Headline);
        $statement->bindValue(':subheadline', $article->Subheadline);
        $statement->bindValue(':sharelink', $article->Sharelink);


        //Execute the statement and insert our values.
        try {
            $inserted = $statement->execute();
        } catch(PDOException $ex) {
            echo $ex;
            return null;
        }
        
        if($inserted) {
            $article->ID = $this->db->lastInsertID();
            echo "Success";
            return $article;
        } else {
            echo "Failure";
            die("Execute query error, because: ". print_r($this->db->errorInfo(),true));

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
                $objArticle->Sharelink = $item['ShareLink'];
                array_push($objArticles, $objArticle);
            }
            
            return $objArticles;
        } catch(PDOException $ex) {
            return array();
        }
    }
    
    public function getByID($articleID) {
        $stmt = $this->db->query("SELECT * FROM articleindex WHERE ID = ".$articleID);
        $article = $stmt->fetch();
        
        if (!empty($article))
        {
            return $article;
        }
        
        return null;
    }

    public function update($article) {
        $values  = "Headline = :headline, Subheadline = :subheadline, ShareLink = :sharelink";
        $sql = "UPDATE ".$this->tableName." SET ".$values." WHERE ID = ".$article["ID"]."";
        
        //Prepare our statement.
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':headline', $article['Headline']);
        $statement->bindValue(':subheadline', $article['Subheadline']);
        $statement->bindValue(':sharelink', $article['ShareLink']);

        try {
            $inserted = $statement->execute();
        } catch(PDOException $ex) {
            return null;
        }
        
        if($inserted) {
            return $article;
        } else {
            return null;
        }
    }
}
?>