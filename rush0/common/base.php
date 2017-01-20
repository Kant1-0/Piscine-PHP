<?php

    // Set the error reporting level
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
 
    // Start a PHP session
    session_start();
 
    // Include site constants
    include_once "inc/constants.inc.php";
 
    // Create a database object
    /*try {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $db = new PDO($dsn, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }*/
    if (!($mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)))
         echo 'Connection to DB failed';

?>