<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'project-university';

try{
    $connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
    $sql = "CREATE TABLE tasks(
        id INT AUTO_INCREMENT,

        user_id INT,
        list_id INT,
        name VARCHAR(50) NOT NULL,
        note VARCHAR(200),
        deadLine DATE,
        done TinyInt NOT NULL DEFAULT 0,
        PRIMARY KEY(id),
        FOREIGN KEY(user_id) REFERENCES Users(id),
        FOREIGN KEY(list_id) REFERENCES Lists(id)

     )";

    $connection->exec($sql);
    echo 'success';

}
catch(Exception $e){
    echo 'error: ' . $e->getMessage();
}