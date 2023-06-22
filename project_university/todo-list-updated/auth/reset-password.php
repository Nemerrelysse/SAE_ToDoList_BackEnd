<?php
require_once '../../database/connectionDB.php';
if (isset($_POST['token']) && $_POST['token'] != '') {
  $token = $_POST["token"];
  $query = "SELECT * FROM users WHERE `forgot_token` = ?";
  $stmt = $connection->prepare($query);
  $stmt->execute([$token]);
  $user = $stmt->fetch();
  if ($user === null) {
    echo 'error';
  } else {
    if (isset($_POST['password']) && strlen($_POST['password']) >= 8) {
      $query = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
      $stmt = $connection->prepare($query);
      $stmt->execute([password_hash($_POST['password'], PASSWORD_DEFAULT), $user->id]);
      header("Location: http://localhost/project-university/todo-list-updated/auth/login.php");
      exit;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="../src/css/base.css" />
  <link rel="stylesheet" href="../src/css/forms.css" />


  <title>Reset Password</title>
</head>

<body>
  <div class="forgotten__password">
    <div class="alert hidden" id="alert"></div>

    <form class="reset__password__form" action="<?= $_SERVER['PHP_SELF'] . '?token=' . $_GET['token'] ?>" method="post">
      <div>
        <label for="password" class="form__label">new Password</label>
        <input type="password" class="password" name="password" id="password" />
        <input type="hidden" name="token" value="<?= isset($_GET['token']) ? $_GET['token']  : '' ?>" id="password" />
        <div class="field__error hidden"></div>
      </div>
      <div class="invalid__feedback hidden"></div>
      <button class="submit__btn" id="submitBtn">Submit</button>
      <div class="valid__feedback hidden"></div>
    </form>
  </div>
</body>

</html>