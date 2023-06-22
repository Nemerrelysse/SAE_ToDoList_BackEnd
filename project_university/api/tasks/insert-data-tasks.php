<?php

header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

//we get the data with the row forrmat
$input = file_get_contents("php://input");
$data = json_decode($input);

$list_id = $data->list_id;
$name = $data->name;
$note = $data->note;
$deadline = $data->deadline;
$done = $data->done;

if (isset($_COOKIE['list_id'])) {
    $list_id = $_COOKIE['list_id'];
}
if (isset($list_id) && $name != "") {
    $query = "INSERT INTO `tasks` (`list_id`, `name`, `user_id`, `note`, `deadline`, `done`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->execute([$list_id, $name, $loggedInUser->id, $note, $deadline, $done]);
    $response = ['status' => "success", 'response' => 'ok', 'code' => 200];
    $response = json_encode($response);
    echo $response;
}

exit;
