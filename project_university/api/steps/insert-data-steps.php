<?php

header("Content-Type: application/json;charset=utf-8");


require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';



//we get the data with the row forrmat
$input = file_get_contents("php://input");
$data = json_decode($input);

$name = $data->name;
$done = $data->done;

$task_id = $_GET["task_id"];

if ($name != "") {
    $query = "INSERT INTO `steps` (`name`, `done`, `task_id`) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->execute([$name, $done, $task_id]);
    $response = ['status' => "success", 'response' => 'ok', 'code' => 200];
    $response = json_encode($response);
    echo $response;

    exit;
}
