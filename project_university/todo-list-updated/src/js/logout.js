window.addEventListener('DOMContentLoaded', function () {
  function delete_cookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
  let logoutBtn = document.querySelector('.logout__btn');
  logoutBtn.addEventListener('click', function () {
    delete_cookie('token');
    window.location.replace("http://localhost/project-university/todo-list-updated/auth/login.php");

  });
});
