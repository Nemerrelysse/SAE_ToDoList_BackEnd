<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

$id = $_GET["id"];
$task_id = $_GET["task_id"];

$query = "SELECT `steps`.* FROM `steps` JOIN `tasks`
ON steps.task_id = tasks.id WHERE steps.id = ? AND steps.task_id = ? AND tasks.user_id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$id, $task_id, $loggedInUser->id]);
$step = $stmt->fetch();
$status = $step->done ? 0 : 1;
$query = "UPDATE `steps` SET  `done` = ?  WHERE `id` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$status, $id]);
$response = ['status' => 'success', 'response' => 'ok', 'code' => 200];
$response = json_encode($response);
echo $response;

exit;
