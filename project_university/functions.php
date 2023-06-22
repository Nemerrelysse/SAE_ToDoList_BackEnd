<?php
 function validateEmail($email)
 {
     $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/";
     if (preg_match($pattern, $email)) {
         echo 'valid email';
     } else {
         echo 'invalid email';
     }
 }

 function validatePassword($password)
 {
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
    if (preg_match($pattern, $password)) {
        echo 'valid password';
    } else {
        echo 'invalid password';
    }
 }

?>