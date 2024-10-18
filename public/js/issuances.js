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

    console.log(issuanceStatus);
}

for (let i = 1; i < rows.length; i++) {
    rows[i].addEventListener('click', selectRow);
}
