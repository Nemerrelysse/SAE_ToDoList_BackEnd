<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'project-university';

try{
    $connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
    $sql = "CREATE TABLE users(
        id INT AUTO_INCREMENT,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        PRIMARY KEY(id),
        UNIQUE(email)
     )";

    $connection->exec($sql);
    echo 'success';

}
catch(Exception $e){
    echo 'error: ' . $e->getMessage();
}