<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'project-university';

try{
    $connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
    $sql = "CREATE TABLE steps(
        id INT AUTO_INCREMENT,
        task_id INT,
        name VARCHAR(50) NOT NULL,
        done TinyInt NOT NULL DEFAULT 0,
        PRIMARY KEY(id),
        FOREIGN KEY(task_id) REFERENCES Tasks(id)
     )";

    $connection->exec($sql);
    echo 'success';

}
catch(Exception $e){
    echo 'error: ' . $e->getMessage();
}