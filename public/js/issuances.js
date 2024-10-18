const acceptButton = document.getElementById('issuanceAccept');
const rejectButton = document.getElementById('issuanceReject');
const returnButton = document.getElementById('issuanceReturn');

acceptButton.style.display = 'none';
rejectButton.style.display = 'none';
returnButton.style.display = 'none';

let issuanceId;


function updateStatus() {
    const selected = document.querySelector('.selected');
    const cells = selected.getElementsByTagName('td');
    const statusSpan = cells[4].querySelector('.status');
    const issuanceStatus = statusSpan.classList[1];

    issuanceId = selected.getAttribute('data-id');
    updateButtons(issuanceStatus);
}

function updateButtons(status) {
    acceptButton.style.display = 'none';
    rejectButton.style.display = 'none';
    returnButton.style.display = 'none';

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
    rows[i].addEventListener('click', updateStatus);
}

function sendStatusUpdate(newStatus) {
    const confirmation = confirm("Вы уверены в данной операции?");

    if (!confirmation) {
        return;
    }

    fetch('/issuances/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ issuanceId, status: newStatus })
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

acceptButton.addEventListener('click', () => sendStatusUpdate('issued'));
rejectButton.addEventListener('click', () => sendStatusUpdate('rejected'));
returnButton.addEventListener('click', () => sendStatusUpdate('returned'));
