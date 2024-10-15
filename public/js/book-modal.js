/**
 * @typedef {Object} Book
 * @property {string} title
 * @property {string} publisher
 * @property {number} book_year
 * @property {string} type
 * @property {number} amount
 * @property {number} issuances
 * @property {array} authors
 */

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

titleInput = document.getElementById('title');
publisherInput = document.getElementById('publisher');
yearInput = document.getElementById('year');
typeInput = document.getElementById('type');
amountInput = document.getElementById('amount');

/** @type {Book} */
let book;


// Открыть окно регистрации читателя
openCreateModalButton.onclick = function () {
    bookModal.style.display = 'flex';
    modalName.textContent = 'Создание книги';
    deleteButton.style.display = 'none';

    titleInput.value = '';
    publisherInput.value = '';
    yearInput.value = '2024';
    typeInput.value = 'fiction';
    amountInput.value = '1';
}


// Открыть окно редактирования пользователя
openEditModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        const row = button.closest('tr');
        const bookId = row.getAttribute('data-id');

        fetch('/get-book', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: bookId,
            })
        })
            .then(response => {
                if (!response.ok) { throw new Error('Не удалось выполнить Fetch-запрос'); }
                return response.json();
            })
            .then(data => {
                book = data.data;

                titleInput.value = book.title;
                publisherInput.value = book.publisher;
                yearInput.value = book.book_year;
                typeInput.value = book.type;
                amountInput.value = book.amount;

                bookModal.style.display = "flex";
                modalName.textContent = 'Редактирование книги';
                deleteButton.style.display = 'block';
            })
            .catch(error => {
                alert(error);
                console.error(error);
            });
    });
});


// Закрыть модальное окно
closeModalButton.onclick = function () {
    bookModal.style.display = "none";
}
