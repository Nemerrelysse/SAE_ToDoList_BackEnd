<?php

header("Content-Type: application/json;charset=utf-8");
require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

$query = "SELECT * FROM lists WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$loggedInUser->id]);
$lists = $stmt->fetchAll();
$response = ['status' => 'success', 'data' => $lists, 'code' => 200];
$response = json_encode($response);
echo $response;

exit;
