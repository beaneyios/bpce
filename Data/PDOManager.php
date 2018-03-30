<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDOManager
 *
 * @author Matt
 */
class PDOManager {
    private static $host = "localhost";
    private static $username = "";
    private static $password = "";
    
    static function PDO() {
        return new PDO('mysql:host='. self::$host.';dbname=news;charset=utf8mb4', self::$username, self::$password);
    }
}
