<?php

$host = "localhost";
$hostUsername = 'nikolajdev';
$password = '199629Nikolaj';
$database = "testdev_blueocean";

try {
    $dbCon = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $hostUsername, $password);
    $dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $example) {
    echo $example->getMessage();
}
include_once 'class/crud.php';
include_once 'class/user.php';

$user = new user();
$crud = new crud($dbCon);
?>