<?php

header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

//we get the data with the row forrmat
$input = file_get_contents("php://input");
$data = json_decode($input);

$name = $data->name;

$query = "SELECT * FROM `lists` WHERE `name` = ? AND `user_id` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$name, $loggedInUser->id]);
$list = $stmt->fetch();
if ($list === false) {
    $query = "INSERT INTO `lists` (`user_id`, `name`) VALUES (?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->execute([$loggedInUser->id, $name]);
    $response = ['status' => "success", 'response' => 'ok', 'code' => 200];
    $response = json_encode($response);
    echo $response;
} else {
    $response = ['status' => 401, 'response' => 'list is existed.'];
    $response = json_encode($response);
    echo $response;
}

exit;
