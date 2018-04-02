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

include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Database/Model/EnvironmentVariables.php");
include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Database/Interfaces/PDOSelectorInterface.php");

class MySQLPDOManager implements PDOSelectorInterface {
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    
    static function PDO() {
        return new PDO('mysql:host='. self::$host.';dbname=news;charset=utf8mb4', self::$username, self::$password);
    }
}

class PostGresPDOManager implements PDOSelectorInterface {    
    static function PDO() {
        $credentials = EnvironmentVariables::databaseCredentials();

        return new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $credentials->host,
            $credentials->port,
            $credentials->username,
            $credentials->password,
            $credentials->database, "/")
        );
    }
}

class PDOSelector implements PDOSelectorInterface {
    static function PDO() {
        return PostGresPDOManager::PDO();
    }
}

