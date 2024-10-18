const table = document.getElementById('info-table');
const rows = table.getElementsByTagName('tr');
const functionsRight = document.querySelector('.functions-right');

const acceptButton = document.getElementById('issuanceAccept');
const rejectButton = document.getElementById('issuanceReject');
const returnButton = document.getElementById('issuanceReturn');


function selectRow(event) {
    for (let i = 1; i < rows.length; i++) {
        rows[i].classList.remove('selected');
    }

    const selected = event.currentTarget;
    selected.classList.add('selected');

    const cells = selected.getElementsByTagName('td');
    const statusSpan = cells[4].querySelector('.status');
    const issuanceStatus = statusSpan.classList[1];

    const id = selected.getAttribute('data-id');

    updateButtons(issuanceStatus, id);
}

function updateButtons(status, id) {
    acceptButton.style.display = 'none';
    rejectButton.style.display = 'none';
    returnButton.style.display = 'none';

    // acceptButton.removeEventListener('click', submitCreate);
    // rejectButton.removeEventListener('click', submitEdit);
    // returnButton.removeEventListener('click', submitCreate);

    switch (status) {
        case 'pending':
            acceptButton.style.display = 'inline-block';
            rejectButton.style.display = 'inline-block';
            break;
        case 'issued':
            returnButton.style.display = 'inline-block';
            break;
        default:
            break;
    }
}

for (let i = 1; i < rows.length; i++) {
    rows[i].addEventListener('click', selectRow);
}

