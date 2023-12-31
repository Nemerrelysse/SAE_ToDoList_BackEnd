<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../src/css/base.css" />
    <link rel="stylesheet" href="../src/css/forms.css" />

    <script defer src="src/js/updatepassword.js"></script>

    <title>Update Password</title>
  </head>
  <body>
    <div class="update__password">
      <form class="update__password__form">
        <div>
          <label for="password" class="form__label">Nouveau mot de passe</label>
          <input type="password" class="password" id="password" placeholder="password" />
          <div class="field__error hidden"></div>
        </div>
        <div>
          <label for="confirm__password" class="form__label">Confirmer le nouveau mot de passe</label>
          <input type="password" class="confirm__password" id="confirm__password" placeholder="password" />
          <div class="field__error hidden"></div>
        </div>
        <div class="invalid__feedback hidden"></div>
        <button class="submit__btn">Envoyer</button>
        <div class="valid__feedback hidden"></div>
      </form>
    </div>
  </body>
</html>
