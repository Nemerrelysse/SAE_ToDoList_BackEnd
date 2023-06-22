<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';
require_once '../users/get-data-users.php';

if (isset($_COOKIE['list_id'])) {
    $list_id = $_COOKIE['list_id'];
}
if (isset($list_id)) {
    $query = "SELECT * FROM tasks WHERE user_id = ? AND list_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$loggedInUser->id, $list_id]);
    $tasks = $stmt->fetchAll();
    $response = ['status' => 'success', 'data' => $tasks, 'code' => 200];
    $response = json_encode($response);
    echo $response;

} else {
    $query = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$loggedInUser->id]);
    $tasks = $stmt->fetchAll();
    $response = ['status' => 'success', 'data' => $tasks, 'code' => 200];
    $response = json_encode($response);
    echo $response;

}

exit;
