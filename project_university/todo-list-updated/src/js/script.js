'use strict';

const homeIcon = document.querySelector('.home__icon');

const main = document.querySelector('.main');

const sidebar = document.querySelector('.sidebar');
const sidebarOpenBtn = document.querySelector('.sidebar__open__icon');
const sidebarCloseIcon = document.querySelector('.sidebar__close__icon');

const taskList = document.querySelector('.task__list');
const taskListNav = document.querySelector('.task__list__nav');

const settings = document.querySelector('.settings');

const editArea = document.querySelector('.edit__area');
const editAreaCloseIcon = document.querySelector('.edit__area__close__icon');
const cancelBtn = document.querySelector('.cancel__btn');

const openModalBtn = document.querySelector('.open__modal__btn');
const closeModalBtn = document.querySelector('.close__modal__btn');
const overlay = document.querySelector('.overlay');

function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = '; expires=' + date.toGMTString();
  } else {
    expires = '';
  }
  document.cookie = name + '=' + value + expires + '; path=/';
}

function getCookie(c_name) {
  if (document.cookie.length > 0) {
    let c_start = document.cookie.indexOf(c_name + '=');
    if (c_start != -1) {
      c_start = c_start + c_name.length + 1;
      let c_end = document.cookie.indexOf(';', c_start);
      if (c_end == -1) {
        c_end = document.cookie.length;
      }
      return unescape(document.cookie.substring(c_start, c_end));
    }
  }
  return '';
}
let token = getCookie('token');

let tasksArray = [];
const getTasks = async () => {
  try {
    const res = await fetch('http://localhost/project-university/api/tasks/get-data-tasks.php', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      tasksArray = [];
      result.data.forEach((task) => {
        tasksArray.push(task);
      });
      updateTaskList(tasksArray);
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
window.addEventListener('load', () => {
  getTasks();
});
// hard-coded data

const getSingleTask = async (taskId) => {
  try {
    const res = await fetch(`http://localhost/project-university/api/tasks/get-single-task.php?id=${taskId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      return result.data;
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
    console.log('error');
  }
};

const getSingleTaskSteps = async (taskId) => {
  try {
    const res = await fetch(`http://localhost/project-university/api/steps/get-spec-steps.php?id=${taskId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      return result.data;
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
    console.log('error');
  }
};

// add new task function
async function addNewTask(taskTitle) {
  try {
    const res = await fetch('http://localhost/project-university/api/tasks/insert-data-tasks.php', {
      method: 'POST',
      body: JSON.stringify({
        list_id: 1,
        name: taskTitle,
        deadline: null,
        done: 0,
        note: null,
      }),
      headers: {
        'Content-type': 'application/json; charset=UTF-8',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      getTasks();
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
    console.log('error');
  }
}

// update task status function
async function updateTaskStatus(taskId) {
  try {
    const res = await fetch(`http://localhost/project-university/api/tasks/change-status-tasks.php?id=${taskId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      tasksArray.forEach((task) => {
        if (task.id === taskId) {
          task.done = !task.done;
        }
      });
      getTasks();
    } else {
      if (res.status === 401) {
        window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
      }
      console.log('there is an error');
    }
  } catch (error) {
    if (res.status === 401) {
      window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
    }
    console.log('error');
  }
}

// delete task function
async function deleteTask(taskId) {
  try {
    const res = await fetch(`http://localhost/project-university/api/tasks/delete-data-tasks.php?id=${taskId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });
    const result = await res.json();
    console.log("hi");
    if (result.status == 'success' && result.code === 200) {
      tasksArray = tasksArray.filter((task) => task.id != taskId);
      getTasks();
    } else {
      if (res.status === 401) {
        window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
      }
      console.log('there is an error');
    }
  } catch (error) {
    if (res.status === 401) {
      window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
    }
    console.log('error');
  }
}

function setAllEventListeners() {
  const taskTitles = document.querySelectorAll('.task__title');
  const checkboxes = document.querySelectorAll('.checkbox');
  const deleteButtons = document.querySelectorAll('.delete__task__icon');
  const addTaskInput = document.querySelector('.add__task__input');
  const addTaskIcon = document.querySelector('.add__task__icon');

  taskTitles.forEach((taskTitle) => {
    taskTitle.addEventListener('click', getEditDetails);
  });

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('click', function () {
      const task = this.closest('.task');
      updateTaskStatus(task.dataset.id);
    });
  });

  deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', function () {
      const task = this.closest('.task');
      deleteTask(task.dataset.id);
    });
  });

  addTaskIcon.addEventListener('click', function () {
    addNewTask(addTaskInput.value);
  });

  addTaskInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') addNewTask(addTaskInput.value);
  });
}

function displayTaskDetails(task) {
  if (task.steps || task.deadline || task.note) {
    return `<ul class="task__details">
      <li class="task__deadline">EchÃŠance : ${task.deadLine}</li>
    <li class="task__note">Note  : ${task.note}</li>
  </ul>`;
  }
  return '';
}

function updateTaskList(tasksInput) {
  taskListNav.innerHTML = '';

  let html = '';

  tasksInput.forEach((task) => {
    html += `
    <li class="task" data-id="${task.id}" >
      <label class="checkbox__container">
        <input class="checkbox" type="checkbox" ${task.done == 1 ? 'checked' : null}/>
        <span class="checkmark"></span>
      </label>
      <div class="task__body">
      ${task.done == 1 ? `<s class="task__title">${task.name}</s>` : `<h3 class="task__title">${task.name}</h3>`}
      ${displayTaskDetails(task)}
      </div>
      <img src="src/icons/delete.svg" alt="trash can" class="delete__task__icon" />
    </li>`;
  });

  html += `
  <li class="add__task">
    <input type="text" placeholder="Ajouter une tÃĸche..." class="add__task__input" />
    <img src="src/icons/plus-dark.svg" alt="trash can" class="add__task__icon" />
  </li>`;

  taskListNav.insertAdjacentHTML('beforeend', html);

  setAllEventListeners();
}

// close edit area
editAreaCloseIcon.addEventListener('click', function () {
  main.classList.remove('edit__area__open');
  editArea.classList.remove('open');
});

// close edit area
cancelBtn.addEventListener('click', function () {
  main.classList.remove('edit__area__open');
  editArea.classList.remove('open');
});

// open task list
homeIcon.addEventListener('click', function () {
  taskList.classList.remove('close');
  settings.classList.add('close');
});

// open sidebar
sidebarOpenBtn.addEventListener('click', function () {
  sidebar.classList.add('open');
});

// close sidebar
sidebarCloseIcon.addEventListener('click', function () {
  sidebar.classList.remove('open');
});

// close modal
closeModalBtn.addEventListener('click', () => {
  overlay.classList.toggle('hidden');
});

async function getEditDetails() {
  let taskTitleInput = document.querySelector('.task__title__input');
  let taskNoteInput = document.querySelector('.task__note__input');
  let taskDeadlineInput = document.querySelector('.task__deadline__input');
  let taskListIdInput = document.querySelector('.task__list__id__input');
  let taskIdInput = document.querySelector('.task__id__input');

  let taskId = this.parentNode.parentNode.dataset.id;
  let task = await getSingleTask(taskId);
  taskTitleInput.value = task.name;
  taskNoteInput.value = task.note;
  taskDeadlineInput.value = task.deadLine;
  taskIdInput.value = task.id;
  taskListIdInput.value = task.list_id;

  //delete single input step
  const deleteStepBtns = document.querySelectorAll('.remove__step__icon');
  deleteStepBtns.forEach((deleteStepBtn) => {
    deleteStepBtn.addEventListener('click', function () {
      const taskStep = this.closest('.task__step');
      taskStep.remove();
    });
  });
  ///

  //get and show spec steps
  let steps = await getSingleTaskSteps(taskIdInput.value);
  let stepContainer = document.querySelector('.task__steps__nav');
  stepContainer.innerHTML = '';
  steps.map((step) => {
    stepContainer.innerHTML += `<li class="task__step">
    <div class="step__body">
      <label class="checkbox__container">
        <input type="checkbox" class ${step.done == 1 && 'checked'} />
        <span class="checkmark stepChange"></span>
      </label>
      <input class="step__title" value="${step.name}" id=${step.id} data-task=${taskIdInput.value}>
    </div>
    <img src="src/icons/remove.svg" alt="remove icon" class="remove__step__icon" />
  </li>`;
  });
  ///

  //remove step
  const removeStepBtns = document.querySelectorAll('.remove__step__icon');
  removeStepBtns.forEach(async (removeStepBtn) => {
    removeStepBtn.addEventListener('click', async function () {
      //delete api
      try {
        const taskStep = this.closest('.task__step');
        const res = await fetch(
          `http://localhost/project-university/api/steps/delete-data-steps.php?id=${taskStep.firstElementChild.children[1].id}&task_id=${taskStep.firstElementChild.children[1].dataset.task}`,
          {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
              Authorization: `Bearer ${token}`,
            },
          }
        );
        const result = await res.json();
        if (result.status == 'success' && result.code === 200) {
          taskStep.remove();
        } else {
          if (res.status === 401) {
            window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
          }
          console.log('there is an error');
        }
      } catch (error) {
        if (res.status === 401) {
          window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
        }
        console.log('error');
      }
    });
  });

  main.classList.add('edit__area__open');
  editArea.classList.add('open');

  //steps change status
  const stepCheckboxes = document.querySelectorAll('.stepChange');
  stepCheckboxes.forEach((stepCheckboxe) => {
    stepCheckboxe.addEventListener('click', function () {
      const step = this.parentNode.nextElementSibling;
      updateStepStatus(step.id, step.dataset.task);
    });
  });

  // update task status function
  async function updateStepStatus(stepId, taskId) {
    try {
      const res = await fetch(
        `http://localhost/project-university/api/steps/change-status-step.php?id=${stepId}&task_id=${taskId}`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${token}`,
          },
        }
      );
      const result = await res.json();
      if (result.status == 'success' && result.code === 200) {
        tasksArray.forEach((task) => {
          if (task.id === taskId) {
            task.done = !task.done;
          }
        });
        getTasks();
      } else {
        if (res.status === 401) {
          window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
        }
        console.log('there is an error');
      }
    } catch (error) {
      if (res.status === 401) {
        window.location.href = 'http://localhost/project-university/todo-list-updated/auth/login.php';
      }
      console.log('error');
    }
  }
}

// add new input for task step
const addStepBtns = document.querySelectorAll('.add__step__icon');
addStepBtns.forEach((addStepBtn) => {
  addStepBtn.addEventListener('click', function () {
    const taskStep = document.querySelector('.task__steps__nav');
    taskStep.innerHTML += `<li class="task__step">
    <div class="step__body">
      <label class="checkbox__container">
        <input type="checkbox" class="check-done">
        <span class="checkmark"></span>
      </label>
      <input class="step__title">
    </div>
  </li>`;
  });
});
//

const updateBtn = document.querySelector('.register__btn');
updateBtn.addEventListener('click', function (e) {
  updateDetailsTask();
});

async function updateDetailsTask() {
  let taskTitleInput = document.querySelector('.task__title__input');
  let taskNoteInput = document.querySelector('.task__note__input');
  let taskDeadlineInput = document.querySelector('.task__deadline__input');
  let taskListIdInput = document.querySelector('.task__list__id__input');
  let taskIdInput = document.querySelector('.task__id__input');

  // update task
  try {
    const res = await fetch(
      `http://localhost/project-university/api/tasks/update-data-tasks.php?id=${taskIdInput.value}`,
      {
        method: 'PATCH',
        body: JSON.stringify({
          name: taskTitleInput.value,
          deadline: taskDeadlineInput.value,
          note: taskNoteInput.value,
        }),
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          Authorization: `Bearer ${token}`,
        },
      }
    );
    const result = await res.json();
    if (result.status == 'success' && result.code === 200) {
      getTasks();
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
    console.log('error');
  }

  // update step
  let stepTitles = document.querySelectorAll('.step__title');
  [...stepTitles].map(async (stepTitle) => {
    //update step
    if (stepTitle.id) {
      try {
        const res = await fetch(
          `http://localhost/project-university/api/steps/update-data-steps.php?id=${stepTitle.id}&task_id=${stepTitle.dataset.task}`,
          {
            method: 'PATCH',
            body: JSON.stringify({
              name: stepTitle.value,
              done: stepTitle.parentElement.firstElementChild.children[0].checked ? 1 : 0,
            }),
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
              Authorization: `Bearer ${token}`,
            },
          }
        );
        const result = await res.json();
        if (result.status == 'success' && result.code === 200) {
          getTasks();
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
        console.log('error');
      }
    }
    //new step
    else {
      console.log('hi');
      try {
        const res = await fetch(
          `http://localhost/project-university/api/steps/insert-data-steps.php?task_id=${taskIdInput.value}`,
          {
            method: 'POST',
            body: JSON.stringify({
              name: stepTitle.value,
              done: stepTitle.parentElement.firstElementChild.children[0].checked ? 1 : 0,
            }),
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
              Authorization: `Bearer ${token}`,
            },
          }
        );
        const result = await res.json();
        if (result.status == 'success' && result.code === 200) {
          // location.reload();
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
        console.log('error');
      }
    }
  });
}
