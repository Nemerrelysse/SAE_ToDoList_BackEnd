<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';

$token = $_GET["token"];

$query = "SELECT * FROM users WHERE `verify_token` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$token]);
$user = $stmt->fetch();
$response = ['status' => 'success', 'data' => $user];
$response = json_encode($response);
exit;
