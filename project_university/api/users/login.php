<?php

use Firebase\JWT\JWT;

require_once '../../database/connectionDB.php';
include '../../vendor/autoload.php';

$input = file_get_contents("php://input");
$data = json_decode($input);

$email = $data->email;
$password = $data->password;

if (!empty($email) || !empty($password)) {
    $query = "SELECT * FROM users WHERE `email` = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user != null) {
        if (password_verify($password, $user->password) && $user->is_active == 1) {
            $secretKey = 'sadsakofgdasn22389';
            $payload = [
                'iat' => time(),
                'nbf' => time() + 20,
                'exp' => time() + 86400 * 30,
                'data' => ['email' => $email],
            ];
            $jsonWebToken = JWT::encode($payload, $secretKey, 'HS256');
            $response = ['status' => "success", 'response' => 'ok', 'token' => $jsonWebToken];
            $response = json_encode($response);
            echo $response;
            exit;
        } else {
            $response = ['status' => 401, 'response' => 'Credentials Error'];
            $response = json_encode($response);
            echo $response;
            exit;
        }
    }
    else{
        $response = ['status' => 401, 'response' => 'Credentials Error'];
        $response = json_encode($response);
        echo $response;
        exit;
    }
}
