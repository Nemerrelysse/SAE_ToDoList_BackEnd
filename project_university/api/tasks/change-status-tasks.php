<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

$id = $_GET["id"];

$query = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$id, $loggedInUser->id]);
$task = $stmt->fetch();
$status = $task->done ? 0 : 1;
$query = "UPDATE `tasks` SET  `done` = ?  WHERE `id` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$status, $id]);
$response = ['status' => 'success', 'response' => 'ok', 'code' => 200];
$response = json_encode($response);
echo $response;

exit;
