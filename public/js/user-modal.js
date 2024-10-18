/**
 * @type {HTMLDivElement}
 */
const userModal = document.getElementById('modal');
const closeModalButton = document.getElementById('close');
const modalName = document.getElementById('modal-name');

// Кнопки открытия модальных окон
const openRegisterModalButton = document.getElementById('userRegisterBtn');
const openEditModalButtons = document.querySelectorAll('.edit-btn');

/**
 * @type {HTMLButtonElement}
 */
const deleteButton = document.getElementById('delete-button');
const saveButton = document.getElementById('save-button');

/**
 * @type {HTMLDivElement}
 */
const passwordGroup = document.getElementById('password-group');

const firstNameInput = document.getElementById('firstName');
const lastNameInput = document.getElementById('lastName');
const loginInput = document.getElementById('login');
const passwordInput = document.getElementById('password');
const groupInput = document.getElementById('group');

let userId;



// Открыть окно регистрации читателя
openRegisterModalButton.onclick = function() {
    deleteButton.style.display = 'none';
    passwordGroup.style.display = 'flex'

    firstNameInput.value = '';
    lastNameInput.value = '';
    loginInput.value = '';
    groupInput.value = '';
    passwordInput.value = '';

    saveButton.addEventListener('click', submitRegister);

    modalName.textContent = 'Регистрация читателя';
    userModal.style.display = 'flex';
}


// Открыть окно редактирования пользователя
openEditModalButtons.forEach(button => {
    button.addEventListener('click', function() {
        const row = button.closest('tr');
        const cells = row.getElementsByTagName('td');

        userId = row.getAttribute('data-id');

        let login = cells[1].innerText;
        let group = (cells[4].innerText !== '-') ? cells[4].innerText : '';

        let full_name = cells[2].innerText.split(' ');
        let first_name = full_name[0];
        let last_name = full_name[1];

        firstNameInput.value = first_name;
        lastNameInput.value = last_name;
        loginInput.value = login;
        groupInput.value = group;

        saveButton.addEventListener('click', submitEdit);
        deleteButton.addEventListener('click', deleteUser);
        deleteButton.style.display = 'block';

        modalName.textContent = 'Редактирование пользователя';
        passwordGroup.style.display = 'none'

        userModal.style.display = 'flex';
    });
});


// Закрыть модальное окно
closeModalButton.onclick = function() {
    userModal.style.display = 'none';

    saveButton.removeEventListener('click', submitRegister);
    saveButton.removeEventListener('click', submitEdit);
    deleteButton.removeEventListener('click', deleteUser);
}



// ФУНКЦИИ И ОБРАБОТЧИКИ

// Сбор данных формы
function getFormData() {
    const firstName = firstNameInput.value;
    const lastName = lastNameInput.value;
    const login = loginInput.value;
    const password = passwordInput.value;
    const group = groupInput.value;

    return {
        userId: 0,
        firstName: firstName,
        lastName: lastName,
        login: login,
        password: password,
        group: group
    };
}

// Сохранение новой книги
function submitRegister() {
    const formData = getFormData();

    fetch('/users/submit-register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                return response.json().then(errorData => {
                    throw new Error(errorData.error);
                });
            }
        })
        .catch(error => {
            alert('Ошибка: ' + error.message);
            console.error(error);
        });
}

// Сохранение редактирования книги
function submitEdit() {
    const formData = getFormData();
    formData['userId'] = userId;

    fetch('/users/submit-edit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                return response.json().then(errorData => {
                    throw new Error(errorData.error);
                });
            }
        })
        .catch(error => {
            alert('Ошибка: ' + error.message);
            console.error(error);
        });
}

// Удаление книги
function deleteUser() {
    const confirmation = confirm("Вы уверены, что хотите удалить пользователя?");

    if (confirmation) {
        fetch(`/users/delete/${userId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
            .then(response => {
                console.log(response);
                if (response.ok) {
                    window.location.reload();
                } else {
                    return response.json().then(errorData => {
                        throw new Error(errorData.message);
                    });
                }
            })
            .catch(error => {
                console.error(error);
                alert("Ошибка: " + error.message);
            });
    }
}
