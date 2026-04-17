<?php
    //for xampp
    $host = "localhost";
    $db = "Final";
    $user = "root";
    $password = "";

    //for web server
    /* $host = "172.31.22.43";
    $db = "Zech200639774";
    $user = "Zech200639774";
    $password = "fMwq4fW4nl"; */

    $dsn = "mysql:host=$host;dbname=$db";

    //try to connect
    try
    {
        $pdo = new PDO($dsn, $user, $password);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    session_start();
?>
