<?php
header("Content-Type: application/json;charset=utf-8");


require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';


$id = $_GET['id'];

$query = "SELECT `steps`.* FROM `steps` JOIN `tasks`
ON steps.task_id = tasks.id WHERE steps.task_id = ? AND tasks.user_id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$id, $loggedInUser->id]);
$steps = $stmt->fetchAll();
$response = ['status' => 'success', 'data' => $steps, 'code' => 200];
$response = json_encode($response);
echo $response;

exit;