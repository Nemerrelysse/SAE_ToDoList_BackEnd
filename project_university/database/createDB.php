<?php

$serverName = 'localhost';
$username = 'root';
$password = '';

try{
    $connection = new PDO("mysql:host=$serverName;", $username, $password);
    $sql = "CREATE DATABASE `project-university`";
    $connection->exec($sql);
    echo 'success';
}
catch(Exception $e){
    echo 'error: ' . $e->getMessage();
}

