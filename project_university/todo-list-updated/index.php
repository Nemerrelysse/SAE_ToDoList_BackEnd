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

  <link rel="stylesheet" href="src/css/base.css" />
  <link rel="stylesheet" href="src/css/style.css" />

  <script defer src="src/js/script.js"></script>
  <script defer src="src/js/list.js"></script>
  <script defer src="src/js/logout.js"></script>
  <title>TODO LIST</title>
</head>

<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar header -->
      <div class="sidebar__header">
        <img src="src/icons/close.svg" alt="close icon" class="sidebar__close__icon" />
        <img src="src/icons/home.svg" alt="home" class="home__icon" />
      </div>

      <!-- User lists -->
      <div class="user__lists">
        <div class="user__lists__title">
          <h3>Mes listes</h3>
          <hr />
        </div>

        <ul class="user__lists__nav " id="lists">



          <!-- List item -->

        </ul>
        <div class="plus">
          <img src="src/icons/plus.svg" alt="logout icon" class="logout__icon" width="50" height="60" />
        </div>
        <div id="create_list" class="hidden">
          <form action="">
            <input type="text" name="name" id="name" class="insert-input">
            <button id="insert" type="button" class="insert-btn">insert</button>
          </form>
        </div>

      </div>

      <!-- Sidebar footer -->
      <div class="sidebar__footer">
        <div class="logout__btn">
          <img src="src/icons/logout.svg" alt="logout icon" class="logout__icon" />
          <span>Déconnexion</span>
        </div>
      </div>
    </div>

    <!-- Main -->
    <div class="main">
      <!-- Navbar -->
      <nav class="navbar">
        <img src="src/icons/menu.svg" alt="menu icon" class="sidebar__open__icon" />
        <h3 class="navbar__title">Accueil / Prochaines tâches</h3>
      </nav>

      <!-- Task list -->
      <div class="task__list">
        <div class="task__list__title">
         
          <h2 class="task__list__header">Prochaines tâches</h2>
          <hr />
        </div>

        <ul class="task__list__nav"></ul>
      </div>

      <!-- Settings -->
      <div class="settings close">
        <h2 class="settings__header">Paramètres</h2>

        <form class="update__email__form">
          <h3 class="form__header">Adresse e-mail</h3>

          <span class="current__email">Adresse e-mail actuelle : jesmo@drazik.com</span>

          <div>
            <label for="email" class="form__label">Nouvelle adresse e-mail</label>
            <input type="text" class="email" placeholder="mail@provider.com" />
          </div>

          <div>
            <label for="confirm__email" class="form__label">Confirmer l’adresse e-mail</label>
            <input type="text" class="confirm__email" placeholder="mail@provider.com" />
          </div>

          <button class="submit__btn">Modifier l’adresse e-mail</button>
        </form>

        <form class="update__pass__form">
          <h3 class="form__header">Mot de passe</h3>

          <div>
            <label for="current__pass" class="form__label">Mot de passe actuel</label>
            <input type="password" class="current__pass" placeholder="password" />
          </div>

          <div>
            <label for="new__pass" class="form__label">Nouveau mot de passe</label>
            <input type="password" class="new__pass" placeholder="password" />
          </div>

          <div>
            <label for="confirm__new__pass" class="form__label">Confirmer le nouveau mot de passe</label>
            <input type="password" class="confirm__new__pass" placeholder="password" />
          </div>

          <button class="submit__btn">Modifier le mot de passe</button>
        </form>
      </div>
    </div>

    <!-- Edit area -->

    <div class="edit__area">
      <div class="task__title__edit">
        <label for="task__title__input" class="form__label">Titre</label>
        <input type="text" class="task__title__input" value="Créer un repository sur github" />
        <img src="src/icons/close.svg" alt="close icon" class="edit__area__close__icon" />
      </div>

      <div class="task__steps__edit">
        <h3 class="task__steps__title">Etapes</h3>
        <ul class="task__steps__nav">


        </ul>
      </div>
      <div class="task__deadline__edit">
        <div><img src="src/icons/plus-dark.svg" alt="dark plus" class="add__step__icon" /></div>
      </div>

      <div class="task__deadline__edit">
        <label for="task__deadline__input" class="form__label">Echéance</label>
        <input type="date" class="task__deadline__input" required />
      </div>

      <div class="task__note__edit">
        <label for="task__note__input" class="form__label">Note</label>
        <textarea type="text" class="task__note__input" placeholder="Quelques détails à propos de cette tâche..."></textarea>
      </div>
      <div class="task__id__edit">
        <input type="hidden" class="task__id__input" />
      </div>

      <div class="task__list__id__edit">
        <input type="hidden" class="task__list__id__input" />
      </div>

      <div class="edit__buttons">
        <button class="register__btn">Enregistrer</button>
        <button class="cancel__btn">Annuler</button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="overlay hidden">
    <div class="modal">
      <h2 class="modal__header">Supprimer la liste ?</h2>

      <div class="modal__body">
        <p class="modal__description">
          Après avoir été supprimée, une liste ne peut pas être récupérée. Êtes-vous certain(e) de vouloir supprimer
          la liste “Projet tutoré” ?
        </p>
        <div class="modal__buttons">
          <button class="clear__list__btn">
            <img src="src/icons/delete-forever.svg" alt="poubelle" />
            <span>Supprimer la liste</span>
          </button>
          <button class="close__modal__btn">
            <img src="src/icons/arrow-back.svg" alt="arrow back" />
            <span>Annuler</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>