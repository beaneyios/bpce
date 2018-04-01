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
class MySQLPDOManager {
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    
    static function PDO() {
        return new PDO('mysql:host='. self::$host.';dbname=news;charset=utf8mb4', self::$username, self::$password);
    }
}

class PostGresPDOManager {
    private static $host = "ec2-23-21-121-220.compute-1.amazonaws.com";
    private static $username = "wuxglbiyawrogm";
    private static $password = "92b8b8c354c7bfdcf49059e9b8564d003bf00eeb091f3ef87909fbb5937b52ad";
    private static $database = "de6a51rpmgolq8";
    private static $port = 5432;

    // private static $host = "localhost";
    // private static $username = "mattbeaney";
    // private static $password = "59570";
    // private static $database = "mattbeaney";
    // private static $port = 5432;
    
    static function PDO() {
        return new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            self::$host,
            self::$port,
            self::$username,
            self::$password,
            self::$database, "/")
        );
        
        /**$db = parse_url(getenv("DATABASE_URL"));
                
        return new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));*/
    }
}