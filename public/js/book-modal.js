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
                    const authorName = document.createElement('div');
                    authorName.classList.add('author-name')

                    authorName.innerHTML = `
                        <span class="author-first-name">${ author.first_name }</span>
                        <span class="author-last-name">${ author.last_name }</span>
                        <span class="remove" onclick="removeAuthor(this)">✖</span>
                    `;

                    authorList.appendChild(authorName);
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


//  ФУНКЦИИ

// Удаление автора
function removeAuthor(element) {
    // Находим родительский элемент .author-name и удаляем его
    const authorName = element.closest('.author-name');
    authorName.remove();
}
