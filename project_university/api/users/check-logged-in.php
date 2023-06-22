<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Content-Type: application/json;charset=utf-8");

/**
 * Get header Authorization
 * */
function getAuthorizationHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

/**
 * get access token from header
 * */
function getBearerToken()
{
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

include '../../vendor/autoload.php';

$data = json_decode(file_get_contents("php://input"));
$secret_key = "sadsakofgdasn22389";

$jwt = getBearerToken() ? getBearerToken() : "";
if ($jwt) {

    try {
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
        $loggedInUserEmail = $decoded->data->email;
        http_response_code(200);

    } catch (Exception $e) {
        http_response_code(401);
        // show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage(),
        ));
        die();
    }
} else {
    header('HTTP/1.0 401 Unauthorized');
    http_response_code(401);
    echo json_encode(array(
        "message" => "Access denied. 401",
    ));
    die();
}
