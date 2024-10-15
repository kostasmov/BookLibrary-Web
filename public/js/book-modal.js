/**
 * @type {HTMLDivElement}
 */
const bookModal = document.getElementById('modal');
const closeModalButton = document.getElementById('close');
const modalName = document.getElementById('modal-name');

// Кнопки открытия модальных окон
const openCreateModalButton = document.getElementById("bookCreateBtn");
const openEditModalButtons = document.querySelectorAll(".edit-btn");

/**
 * @type {HTMLButtonElement}
 */
const deleteButton = document.getElementById('delete-button');
const saveButton = document.getElementById('save-button');


// Открыть окно регистрации читателя
openCreateModalButton.onclick = function () {
    bookModal.style.display = 'flex';
    modalName.textContent = 'Создание книги';
    deleteButton.style.display = 'none';
}


// Открыть окно редактирования пользователя
openEditModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        // Заполнение формы

        bookModal.style.display = "flex";
        modalName.textContent = 'Редактирование книги';
        deleteButton.style.display = 'block';
    });
});


// Закрыть модальное окно
closeModalButton.onclick = function () {
    bookModal.style.display = "none";
}
