<?php

header("Content-Type: application/json;charset=utf-8");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once '../../vendor/autoload.php';
require_once '../../database/connectionDB.php';
require_once '../../helpers.php';

function random()
{
    return bin2hex(openssl_random_pseudo_bytes(32));
}

function activationMessage($verifyToken)
{
    $message = '
        <h1>activation</h1>
        <p>dear user to verify email please click link below</p>
        <div><a href="' . url('todo-list-updated/auth/activation.php') . '?token=' . $verifyToken . '">Activation</a></div>
        <p>or click link : ' . url('todo-list-updated/auth/activation.php') . '?token=' . $verifyToken . '</p>';
    return $message;
}

function sendMail($emailAddress, $subject, $body)
{

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'testmailer1106@gmail.com'; //SMTP username
        $mail->Password = 'rbkdugisowrqhevl'; //SMTP password
        $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('testmailer1106@gmail.com', 'App');
        $mail->addAddress($emailAddress); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        json_encode('Email Has Been Sent - try to verify your email!!');
        return true;
    } catch (Exception $e) {
        json_encode("Message could not be sent");
        return false;
    }
}
function passHash($password)
{
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashPassword;
}

//we get the data with the row forrmat
$input = file_get_contents("php://input");
$data = json_decode($input);

$email = $data->email;

$query = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user === false) {

    $randomToken = random();
    $activationMessage = activationMessage($randomToken);
    $result = sendMail($email, 'activation', $activationMessage);
    $query = "INSERT INTO `users` (`email`, `password`, `verify_token`) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $password = passHash($data->password);
    $stmt->execute([$email, $password, $randomToken]);
    $response = ['status' => "success", 'response' => 'ok'];
    $response = json_encode($response);
    echo $response;
} else {
    $response = ['status' => 401, 'response' => 'ce mail est deja exist.'];
    $response = json_encode($response);
    echo $response;
}

exit;
