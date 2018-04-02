<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleInterface
 *
 * @author Matt
 */
interface ArticleInterface {
    function create($article);
    function delete($article);
    function get();
    function update($article);
}
