<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'project-university';

try{
    $connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
    $sql = "CREATE TABLE lists(
        id INT AUTO_INCREMENT NOT NULL,
        user_Id INT NOT NULL,
        name VARCHAR(50) NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(user_Id) REFERENCES Users(id)
     )";

    $connection->exec($sql);
    echo 'success';

}
catch(Exception $e){
    echo 'error: ' . $e->getMessage();
}

