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

const addAuthorButton = document.getElementById('add-author-button');
const authorFirstName = document.getElementById('author-fname');
const authorLastName = document.getElementById('author-lname');

const decreaseButton = document.getElementById('amount-decrease');
const increaseButton = document.getElementById('amount-increase');
let issuances = 0;

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

    issuances = 0;
    updateButtons();

    saveButton.addEventListener('click', submitCreate);
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
                if (!response.ok) { throw new Error('Не удалось выполнить Fetch-запрос (загрузка формы)'); }
                return response.json();
            })
            .then(data => {
                book = data.data;

                titleInput.value = book.title;
                publisherInput.value = book.publisher;
                yearInput.value = book.book_year;
                typeInput.value = book.type;
                amountInput.value = book.amount;

                issuances = book.issuances;
                updateButtons();

                authorList.innerHTML = '';
                book.authors.forEach(author => {
                    addAuthor(author.first_name, author.last_name);
                });

                bookModal.style.display = "flex";
                modalName.textContent = 'Редактирование книги';
                deleteButton.style.display = 'block';

               saveButton.addEventListener('click', submitEdit);
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

    saveButton.removeEventListener('click', submitCreate);
    saveButton.removeEventListener('click', submitEdit);
}



//  ФУНКЦИИ И ДОП. ОБРАБОТЧИКИ



// Удаление автора
function removeAuthor(element) {
    // Находим родительский элемент .author-name и удаляем его
    const authorName = element.closest('.author-name');
    authorName.remove();
}

// Установка количества книг и сверка с числом выдач
decreaseButton.addEventListener('click', function () {
    let currentAmount = parseInt(amountInput.value);
    if (currentAmount > issuances) {
        amountInput.value = currentAmount - 1;
    }

    updateButtons();
});

increaseButton.addEventListener('click', function () {
    let currentAmount = parseInt(amountInput.value);
    amountInput.value = currentAmount + 1;
    decreaseButton.disabled = false;

    updateButtons();
});

function updateButtons() {
    let currentAmount = parseInt(amountInput.value, 10);

    decreaseButton.disabled = currentAmount <= issuances;
}


// Сбор данных формы
function getFormData() {
    const title = titleInput.value;
    const publisher = publisherInput.value;
    const year = yearInput.value;
    const type = typeInput.value;
    const amount = amountInput.value;

    const authors = [];
    authorList.querySelectorAll('.author-name').forEach(function(authorElement) {
        const firstName = authorElement.querySelector('.author-first-name').textContent;
        const lastName = authorElement.querySelector('.author-last-name').textContent;
        authors.push({ first_name: firstName, last_name: lastName });
    });

    return {
        title: title,
        publisher: publisher,
        year: year,
        type: type,
        amount: amount,
        authors: authors
    };
}


// Сохранение новой книги
function submitCreate() {
    const formData = getFormData();

    fetch('/catalog/submit-create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Не удалось выполнить Fetch-запрос (отправка формы)');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}


// Сохранение редактирования книги
function submitEdit() {
    const formData = getFormData();

    fetch('/catalog/submit-edit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Не удалось выполнить Fetch-запрос (отправка формы)');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}


// Добавление нового автора
addAuthorButton.addEventListener('click', function() {
    const firstName = authorFirstName.value.trim();
    const lastName = authorLastName.value.trim();

    if (firstName && lastName) {
        addAuthor(firstName, lastName);

        authorFirstName.value = '';
        authorLastName.value = '';
    } else {
        alert('Пожалуйста, заполните оба поля: Имя и Фамилия');
    }
});


// Внесение имени автора в список авторов
function addAuthor(first_name, last_name) {
    const authorName = document.createElement('div');
    authorName.classList.add('author-name')

    authorName.innerHTML = `
        <span class="author-first-name">${first_name}</span>
        <span class="author-last-name">${last_name}</span>
        <span class="remove" onclick="removeAuthor(this)">✖</span>
    `;

    authorList.appendChild(authorName);
}
