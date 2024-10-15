/**
 * @typedef {Object} Author
 * @property {string} first_name
 * @property {string} last_name
 */

/**
 * @typedef {Object} Book
 * @property {string} title
 * @property {string} publisher
 * @property {number} book_year
 * @property {string} type
 * @property {number} amount
 * @property {number} issuances
 * @property {Author[]} authors
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

const titleInput = document.getElementById('title');
const publisherInput = document.getElementById('publisher');
const yearInput = document.getElementById('year');
const typeInput = document.getElementById('type');
const amountInput = document.getElementById('amount');
const authorList = document.getElementById('author-list');

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
    authorList.innerHTML = '';
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

                authorList.innerHTML = '';
                book.authors.forEach(author => {
                    const authorDiv = document.createElement('div');
                    authorDiv.classList.add('author-name');

                    const fullName = `${author.first_name} ${author.last_name}`;
                    authorDiv.innerHTML = `${fullName} <span class="remove-author">✖</span>`;

                    authorList.appendChild(authorDiv);
                });

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
