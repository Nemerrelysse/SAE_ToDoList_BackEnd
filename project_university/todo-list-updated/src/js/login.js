'use strict';



function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
  }

  
const loginForm = document.querySelector('.login__form');

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
    });

    return !allInputs.every((input) => input.value !== '');
}

function validateEmail(inputEmail) {
    const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
    if (pattern.test(inputEmail)) {
        return true;
    } else {
        return false;
    }
}


const displayEmailError = (form, errMsg) => {
    const email = form.querySelector('.email');
    const emailErrContainer = email.nextElementSibling;
    email.classList.add('error');
    emailErrContainer.classList.remove('hidden');
    emailErrContainer.innerHTML = errMsg;
};


loginForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    if (hasEmptyFiled(this)) return;

    let email = document.getElementById('email');
    let password = document.getElementById('password');
    if (!validateEmail(email.value)) {
        displayEmailError(this, 'credentials failed');
        return;
    }

    const alert = document.getElementById('alert');
    try {
        const res = await fetch('http://localhost/project-university/api/users/login.php', {
            method: 'POST',
            body: JSON.stringify({
                email: email.value,
                password: password.value,
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
            if (result.token) {
                createCookie('token', result.token, 1);
                setTimeout(() => {
                    window.location.assign("http://localhost/project-university/todo-list-updated");
                }, 1000)
            }


        } else {
            alert.classList.toggle('hidden');
            alert.innerHTML = result.response;
        }
    } catch (error) {
        alert.classList.toggle('hidden');
        alert.innerHTML = error.message;
        console.log(error);
    }

});
