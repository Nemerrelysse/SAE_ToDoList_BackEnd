<?php
header("Content-Type: application/json;charset=utf-8");

require_once '../../database/connectionDB.php';
require_once '../users/check-logged-in.php';

$query = "SELECT * FROM users WHERE email = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$loggedInUserEmail]);
$loggedInUser = $stmt->fetch();
