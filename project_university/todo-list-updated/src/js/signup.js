'use strict';

const signUpForm = document.querySelector('.sign__up__form');

function toggleErrorMessage(allInputs, messages) {
  allInputs.forEach((input) => {
    const errContainer = input.nextElementSibling;

    // when input is empty remove hidden class
    if (!input.value) {
      input.classList.add('error');
      errContainer.classList.remove('hidden');
      errContainer.innerHTML = messages[input.id];

      // when input is not empty add hidden class
    } else {
      input.classList.remove('error');
      errContainer.classList.add('hidden');
    }
  });
}



function hasEmptyFiled(form) {
  const allInputs = [...form.querySelectorAll('input')];

  toggleErrorMessage(allInputs, {
    email: 'Veuillez renseigner une adresse e-mail',
    password: 'Veuillez renseigner un mot de passe',
    confirm__password: 'Veuillez renseigner un mot de passe',
  });

  return !allInputs.every((input) => input.value !== '');
}

function validateEmail(inputEmail){
  const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
    if (pattern.test(inputEmail)){
        return true;
    } else {
        return false;
    }
}

function validatePassword(password){
   const pattern = /^[A-Za-z0-9]\w{7,}$/;
   if (pattern.test(password)) {
       return true;
   } else {
       return false;
   }
}

function checkMatchingPasswords(form) {
  const password = form.querySelector('.password');
  const confirmPassword = form.querySelector('.confirm__password');
  const passwordErrContainer = confirmPassword.nextElementSibling;

  if (password.value === confirmPassword.value) return true;

  confirmPassword.classList.add('error');
  passwordErrContainer.classList.remove('hidden');
  passwordErrContainer.innerHTML = 'Les mots de passe ne correspondent pas';
  return false;
}

const displayEmailError = (form, errMsg) => {
  const email = form.querySelector('.email');
  const emailErrContainer = email.nextElementSibling;
  email.classList.add('error');
  emailErrContainer.classList.remove('hidden');
  emailErrContainer.innerHTML = errMsg;
};


const displayPasswordError = (form, errMsg) => {
  const password = form.querySelector('.password');
  password.classList.add('error');
  const passwordErrContainer = password.nextElementSibling;
  passwordErrContainer.classList.remove('hidden');
  passwordErrContainer.innerHTML = errMsg;
  return false;
};

signUpForm.addEventListener('submit', async function (e) {
  e.preventDefault();
  if (hasEmptyFiled(this)) return;

  if (!checkMatchingPasswords(this)) return;

  let email = document.getElementById('email');
  let password = document.getElementById('password');
  let confirm = document.getElementById('confirm__password');
  if(!validateEmail(email.value)){
    displayEmailError(this, 'Cette adresse e-mail est ne est pas correct');
    return;
  }

  if(!validatePassword(password.value)){
    displayPasswordError(this, 'Ce password est ne est pas correct');
    return;
  }

 const alert = document.getElementById('alert');
  try {
    const res = await fetch('http://localhost/project-university/api/users/insert-data-users.php', {
      method: 'POST',

      body: JSON.stringify({
        email: email.value,
        password: password.value,
        confirm: confirm.value,
      }),
      headers: {
        'Content-Type': 'application/json',
      },
    });
    const result = await res.json();
    if (result.status == 'success') {
      const btn = document.getElementById('submitBtn');
      btn.innerHTML = "submited";
      btn.classList.add('btn-success');
      btn.disabled = true;
      setTimeout(() => {
      window.location.replace("http://localhost/project-university/todo-list-updated/auth/login.php");
      },1000)
    
    } else {
      alert.classList.toggle('hidden');
      alert.innerHTML=result.response;
      
    }
  } catch (error) {
    alert.classList.toggle('hidden');
    alert.innerHTML=error.message;
  }

});
