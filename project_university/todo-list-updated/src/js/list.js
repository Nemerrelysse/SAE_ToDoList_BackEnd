window.addEventListener('DOMContentLoaded', () => {
  const getLists = async () => {
    try {
      const listsContainer = document.querySelector('#lists');
      let li = '';
      const res = await fetch('http://localhost/project-university/api/lists/get-data-lists.php', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
        },
      });
      const result = await res.json();
      if (result.status == 'success' && result.code === 200) {
        listsContainer.innerHTML = '';
        result.data.map((lists, index) => {
          li = `<li class="list__item">
         <h3 class="list__title" data-id=${lists.id}>${lists.name}</h3>
         </li>`;
          listsContainer.innerHTML += li;
        });
        //get current list
        let listsTitle = document.querySelectorAll('.list__title');
        [...listsTitle].map((listTitle) => {
          listTitle.addEventListener('click', function () {
            createCookie('list_id', listTitle.dataset.id, 1);
            getTasks();
          });
        });
      } else {
        if (res.status === 401) {
          window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
        }
        console.log('there is a problem.');
      }
    } catch (error) {
      if (res.status === 401) {
        window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
      }
      console.log(error);
    }
  };
  getLists();

  const plus = document.querySelector('.plus');
  plus.addEventListener('click', () => {
    const create = document.getElementById('create_list');
    create.classList.toggle('hidden');
  });

  const insert_list = document.getElementById('insert');
  insert_list.addEventListener('click', async () => {
    const nameInput = document.getElementById('name');

    try {
      let token = getCookie('token');
      const res = await fetch('http://localhost/project-university/api/lists/insert-data-lists.php', {
        method: 'POST',
        body: JSON.stringify({
          name: nameInput.value,
        }),
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
        },
      });
      const result = await res.json();
      if (result.status == 'success') {
        getLists();
      } else {
        if (res.status === 401) {
          window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
        }
        console.log('there is problem');
      }
    } catch (error) {
      if (res.status === 401) {
        window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
      }
      console.log('error');
    }
  });
});
