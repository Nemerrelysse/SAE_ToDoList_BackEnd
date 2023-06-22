<?php
require_once '../../database/connectionDB.php';
$token = $_GET["token"];

$query = "SELECT * FROM users WHERE `verify_token` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$token]);
$user = $stmt->fetch();
if ($user === null) {
    echo 'error';
} else {
    $query = "UPDATE `users` SET `is_active` = 1 WHERE `id` = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$user->id]);
    header("Location: http://localhost/project-university/todo-list-updated/auth/login.php");
    exit;
}
