/**
 * @type {HTMLDivElement}
 */
const userModal = document.getElementById('modal');
const closeModalButton = document.getElementById('close');

// Кнопки открытия модальных окон
const openRegisterModalButton = document.getElementById('userRegisterBtn');
const openEditModalButtons = document.querySelectorAll('.edit-btn');

/**
 * @type {HTMLDivElement}
 */
const passwordGroup = document.getElementById('password-group');
const modalName = document.getElementById('modal-name');

/**
 * @type {HTMLButtonElement}
 */
const deleteButton = document.getElementById('delete-button');
const saveButton = document.getElementById('save-button');


// Открыть окно регистрации читателя
openRegisterModalButton.onclick = function() {
    userModal.style.display = 'flex';

    modalName.textContent = 'Регистрация читателя';
    deleteButton.style.display = 'none';
    passwordGroup.style.display = 'flex'
}


// Открыть окно редактирования пользователя
openEditModalButtons.forEach(button => {
    button.addEventListener('click', function() {
        const row = button.closest('tr');
        const cells = row.getElementsByTagName('td');

        let userId = row.id.match(/user-(\d+)/)[1];
        console.log(userId);

        let login = cells[1].innerText;
        let group = (cells[4].innerText !== '-') ? cells[4].innerText : '';

        let full_name = cells[2].innerText.split(' ');
        let first_name = full_name[0];
        let last_name = full_name[1];

        document.getElementById('firstName').value = first_name;
        document.getElementById('lastName').value = last_name;
        document.getElementById('login').value = login;
        document.getElementById('group').value = group;

        userModal.style.display = 'flex';

        modalName.textContent = 'Редактирование пользователя';
        deleteButton.style.display = 'block';
        passwordGroup.style.display = 'none'
    });
});


// Закрыть модальное окно
closeModalButton.onclick = function() {
    userModal.style.display = 'none';

    document.getElementById('firstName').value = '';
    document.getElementById('lastName').value = '';
    document.getElementById('login').value = '';
    document.getElementById('group').value = '';
}
