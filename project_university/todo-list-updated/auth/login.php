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
  <script defer src="../src/js/login.js"></script>

  <title>Login</title>
</head>

<body>
  <div class="alert hidden" id="alert"></div>

  <div class="login">

    <form class="login__form">
      <div>
        <label for="email" class="form__label">Adresse e-mail</label>
        <input type="text" name="email" class="email" id="email" placeholder="mail@provider.com" />
        <div class="field__error hidden"></div>
      </div>
      <div>
        <label for="password" class="form__label">Mot de passe</label>
        <input type="password" name="password" class="password" id="password" placeholder="password" />
        <div class="field__error hidden"></div>
      </div>
      <div class="invalid__feedback hidden"></div>
      <button class="submit__btn" id="submitBtn">Connexion</button>
      <div class="form__links">
        <a href="forgottenpassword.php" class="forget__password__link"><span>J’ai oublié mon mot de passe</span></a>
        <a href="signup.php" class="sign__up__link"><span>Pas encore de compte ? Inscrivez-vous !</span></a>
      </div>
    </form>
  </div>
</body>

</html>
