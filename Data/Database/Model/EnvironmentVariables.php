<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include($_SERVER['DOCUMENT_ROOT']."/bpce/Data/Database/Model/DBCredentials.php");

class EnvironmentVariables {
    public static function databaseCredentials() {
        $credentials = self::localCredentials();
        
        if (getenv("PBCE_ENVIRONMENT") != null && getenv("PBCE_ENVIRONMENT") === "live") {
            $credentials = self::productionCredentials();
        }
        
        return $credentials;
    }
    
    private static function productionCredentials() {
        $credentials = new DBCredentials();
        $credentials->host = "ec2-23-21-121-220.compute-1.amazonaws.com";
        $credentials->username = "wuxglbiyawrogm";
        $credentials->password = "92b8b8c354c7bfdcf49059e9b8564d003bf00eeb091f3ef87909fbb5937b52ad";
        $credentials->database = "de6a51rpmgolq8";
        $credentials->port = 5432;
        return $credentials;
    }
    
    private static function localCredentials() {
        $credentials = new DBCredentials();
        $credentials->host = "localhost";
        $credentials->username = "postgres";
        $credentials->password = "access28";
        $credentials->database = "postgres";
        $credentials->port = "5433";
        return $credentials;
    }
}