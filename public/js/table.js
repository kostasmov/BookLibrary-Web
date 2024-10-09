const table = document.getElementById('info-table');
const rows = table.getElementsByTagName('tr');

function selectRow(event) {
    for (let i = 1; i < rows.length; i++) {
        rows[i].classList.remove('selected');
    }

    event.currentTarget.classList.add('selected');
}

for (let i = 1; i < rows.length; i++) {
    rows[i].addEventListener('click', selectRow);
}
