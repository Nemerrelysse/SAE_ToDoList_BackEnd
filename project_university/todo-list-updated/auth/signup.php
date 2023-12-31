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



  <title>Sign Up</title>
</head>

<body>


  <div class="alert hidden" id="alert"></div>

  <div class="sign__up">
    <form class="sign__up__form">
      <div>
        <label for="email" class="form__label">Adresse e-mail</label>
        <input type="text" class="email" id="email" placeholder="mail@provider.com" />
        <div class="field__error hidden"></div>
      </div>
      <div>
        <label for="password" class="form__label">Mot de passe</label>
        <input type="password" class="password" id="password" placeholder="password" />
        <div class="field__error hidden"></div>
      </div>
      <div>
        <label for="confirm__password" class="form__label">Répéter le mot de passe</label>
        <input type="password" class="confirm__password" id="confirm__password" placeholder="password" />
        <div class="field__error hidden"></div>
      </div>
      <div class="invalid__feedback hidden"></div>
      <button class="submit__btn" id="submitBtn">Inscription</button>


      <div class="valid__feedback hidden"></div>
    </form>
  </div>
  <script defer src="../src/js/signup.js"></script>
</body>

</html>