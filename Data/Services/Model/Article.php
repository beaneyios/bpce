<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Article
 *
 * @author Matt
 */
class Article {
    public $ID;
    public $Headline;
    public $Subheadline;
    public $Sharelink;
    
    public function __toString() {
        return $this->ID . " <br> " . $this->Headline . " <br> " . $this->Subheadline . " <br> " . $this->Sharelink;
    }
}
