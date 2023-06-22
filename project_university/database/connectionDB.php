<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = "project-university";
global $connection;
try{
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
    $connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password, $options);

    return $connection;
}
catch(Exception $e)
{
    echo "Error: " . $e->getMessage();
    return false;
}