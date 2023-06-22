<?php
header("Content-Type: application/json;charset=utf-8");


require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';



$id = $_GET['id'];
$query = "DELETE FROM `lists` WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$id]);
$response = ['status' => 'success', 'response' => 'ok', 'code' => 200];
$response = json_encode($response);
echo $response;

exit;
