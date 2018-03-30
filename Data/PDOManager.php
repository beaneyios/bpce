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

class PostGresPDOManager {
    static function PDO() {
        $db = parse_url(getenv("DATABASE_URL"));
        
        return new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));
    }
}
