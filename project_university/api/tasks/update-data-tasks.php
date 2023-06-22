<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

$input = file_get_contents("php://input");
$data = json_decode($input);

$name = $data->name;
$note = $data->note;
$deadline = $data->deadline;
$id = $_GET["id"];

$query = "UPDATE `tasks` SET   `name` = ?, `note` = ?, `deadline` = ?  WHERE `id` = ? AND user_id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$name, $note, $deadline, $id, $loggedInUser->id]);
$response = ['status' => 'success', 'response' => 'ok', 'code' => 200];
$response = json_encode($response);
echo $response;
exit;
