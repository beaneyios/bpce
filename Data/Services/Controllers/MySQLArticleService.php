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

include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Services/Model/Article.php");
include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Services/Interfaces/ArticleServiceInterface.php");

include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Database/Controllers/PDO.php");

class MySQLArticleService implements ArticleInterface {
    //DB details
    private $db;
    
    //Table details
    private $tableName = "articleindex";
    private $colHeadline = "Headline";
    private $colSubheadline = "Subheadline";
    private $colSharelink = "ShareLink";
    
    public function __construct() {
        $this->db = PDOSelector::PDO();
    }
            
    public function create($article) {           
        $columns = '("'.$this->colHeadline.'", "'.$this->colSubheadline.'", "'.$this->colSharelink.'")';
        $values  = "(:Headline, :Subheadline, :ShareLink)";
        $sql = 'INSERT INTO '.$this->tableName.''.$columns.' VALUES'.$values;
 
        $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

        $statement = $this->db->prepare($sql);

        $statement->bindValue(':Headline', $article->Headline);
        $statement->bindValue(':Subheadline', $article->Subheadline);
        $statement->bindValue(':ShareLink', $article->Sharelink);

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
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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