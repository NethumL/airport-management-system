const BASE_URL = document.head.querySelector("[name=BASE_URL][content]").content;
const alertContainer = document.getElementById("alert-container");

const filterForm = document.getElementById("filter-form");
const filterFormFields = filterForm.querySelectorAll("input,select");

let sortOrder = null;
const table = document.getElementById("flight-table");

let flight = null;
const updateForm = document.getElementById("update-form");
const updateFormFields = updateForm?.querySelectorAll("input,select,textarea");
const clearButton = document.getElementById("clear-button");
const deleteButton = document.getElementById("delete-button");

const resetUpdateForm = () => {
    updateForm.reset();
    flight = null;
}

const showAlert = (message, style) => {
    const div = document.createElement("div");
    div.classList.add("alert", "alert-" + style, "mx-4");
    div.textContent = message;
    div.id = "update-flight-message";
    alertContainer.appendChild(div);
    setTimeout(deleteAlert, 3000);
}

const deleteAlert = () => {
    const alertDiv = document.getElementById("update-flight-message");
    if (alertDiv)
        alertDiv.remove();
}

filterForm.addEventListener("submit", e => {
    e.preventDefault();

    const queryParts = Array.from(filterFormFields).map(field => {
        return field.getAttribute("name") + "=" + encodeURIComponent(field.value);
    });
    const query = "?" + queryParts.join("&");

    const xhttp = new XMLHttpRequest();
    xhttp.withCredentials = true;
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.response);
            const tbody = table.querySelector("tbody");
            tbody.innerHTML = "";
            response.forEach(flight => {
                const tr = document.createElement("tr");
                tr.dataset.id = flight.id;
                const airlineTd = document.createElement("td");
                airlineTd.textContent = flight.airline;
                tr.appendChild(airlineTd);
                const beginTd = document.createElement("td");
                beginTd.textContent = flight.beginName;
                beginTd.dataset.id = flight.begin;
                tr.appendChild(beginTd);
                const endTd = document.createElement("td");
                endTd.textContent = flight.endName;
                endTd.dataset.id = flight.end;
                tr.appendChild(endTd);
                const departureTd = document.createElement("td");
                departureTd.textContent = flight.departureDateTime;
                tr.appendChild(departureTd);
                const arrivalTd = document.createElement("td");
                arrivalTd.textContent = flight.arrivalDateTime;
                tr.appendChild(arrivalTd);
                const economyTd = document.createElement("td");
                economyTd.textContent = flight.economyClassPrice;
                tr.appendChild(economyTd);
                const businessTd = document.createElement("td");
                businessTd.textContent = flight.businessClassPrice;
                tr.appendChild(businessTd);
                const statusTd = document.createElement("td");
                statusTd.textContent = flight.status;
                tr.appendChild(statusTd);
                const viewTd = document.createElement("td");
                viewTd.innerHTML = `<a class = "btn btn-info" href = "${BASE_URL}flight/view/${flight.id}">
                    <i class="fa-solid fa-eye"></i>
                </a>`;
                tr.appendChild(viewTd);
                if (canEdit) {
                    const editTd = document.createElement("td");
                    editTd.innerHTML = "<button class=\"btn btn-warning edit-button\"><i class=\"fa-solid fa-pen-to-square fa-1x\"></i></button>"
                    tr.appendChild(editTd);
                }
                tbody.appendChild(tr);
            });
        }
    }
    xhttp.open("GET", BASE_URL + "flight/search" + query, true);
    xhttp.send();
});

const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => {
    const v1 = getCellValue(asc ? a : b, idx);
    const v2 = getCellValue(asc ? b : a, idx);
    return (v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2)) ? v1 - v2 : v1.toString().localeCompare(v2);
};

document.querySelectorAll('th').forEach(th => th.addEventListener('click', e => {
    // Set icons
    const span = e.currentTarget.querySelector("span");
    if (!span)
        return;
    const icon = "sort-" + (sortOrder ? "up" : "down");
    span.innerHTML = `<i class="fas fa-solid fa-${icon}"></i>`;
    table.querySelectorAll("th").forEach(x => {
        if (x.cellIndex !== th.cellIndex) { // Remove other icons
            const span = x.querySelector("span");
            if (!span)
                return;
            span.innerHTML = "<i class='fas fa-solid fa-sort'></i>";
        }
    });

    // Sort table
    sortOrder = !sortOrder;
    const tbody = table.querySelector("tbody");
    Array.from(tbody.querySelectorAll('tr'))
        .sort(comparer(th.cellIndex, sortOrder))
        .forEach(tr => tbody.appendChild(tr));
}));

const editFlight = (row) => {
    resetUpdateForm();
    const {id} = row.dataset;
    const [
        {textContent: airline},
        {textContent: beginName, dataset: {id: begin}},
        {textContent: endName, dataset: {id: end}},
        {textContent: departureDateTime},
        {textContent: arrivalDateTime},
        {textContent: economyClassPrice},
        {textContent: businessClassPrice},
        {textContent: status}
    ] = row.children;

    updateFormFields[0].value = airline;
    updateFormFields[1].value = status;
    updateFormFields[2].value = begin;
    updateFormFields[3].value = end;
    updateFormFields[4].value = departureDateTime;
    updateFormFields[5].value = arrivalDateTime;
    updateFormFields[6].value = economyClassPrice;
    updateFormFields[7].value = businessClassPrice;
    flight = {
        id,
        airline,
        begin,
        beginName,
        end,
        endName,
        departureDateTime,
        arrivalDateTime,
        economyClassPrice,
        businessClassPrice,
        status
    };
};

table.querySelector("tbody").addEventListener("click", e => {
    const row = e.target.closest("tr");
    if ((e.target.nodeName === "I" || e.target.nodeName === "BUTTON") && canEdit)
        editFlight(row);
});

updateForm?.addEventListener("submit", e => {
    e.preventDefault();

    if (!flight)
        return;

    if (flight.airline === updateFormFields[0].value
        && flight.begin === updateFormFields[2].value
        && flight.end === updateFormFields[3].value
        && flight.departureDateTime === updateFormFields[4].value
        && flight.arrivalDateTime === updateFormFields[5].value
        && flight.economyClassPrice === updateFormFields[6].value
        && flight.businessClassPrice === updateFormFields[7].value
        && flight.status === updateFormFields[1].value) {
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.withCredentials = true;
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const response = JSON.parse(this.response);
                console.log(response);
                const row = Array.from(table.querySelectorAll("tbody tr")).find(row => row.dataset.id == response.id);
                if (row) {
                    row.children[0].textContent = response.airline;
                    row.children[1].textContent = response.beginName;
                    row.children[1].dataset.id = response.begin;
                    row.children[2].textContent = response.endName;
                    row.children[2].dataset.id = response.end;
                    row.children[3].textContent = response.departureDateTime;
                    row.children[4].textContent = response.arrivalDateTime;
                    row.children[5].textContent = response.economyClassPrice;
                    row.children[6].textContent = response.businessClassPrice;
                    row.children[7].textContent = response.status;
                }
                resetUpdateForm();
                showAlert("Flight successfully updated", "success");
            } else {
                showAlert("Flight update failed", "danger");
            }
        }
    };
    xhttp.open("POST", BASE_URL + "flight/index/" + encodeURIComponent(flight.id), true);
    xhttp.send(new FormData(updateForm));
});

clearButton?.addEventListener("click", resetUpdateForm);

deleteButton?.addEventListener("click", () => {
    if (!flight)
        return;

    const xhttp = new XMLHttpRequest();
    xhttp.withCredentials = true;
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const row = Array.from(table.querySelectorAll("tbody tr")).find(row => row.dataset.id === flight.id);
            if (row) {
                row.remove();
            }
            resetUpdateForm()
        }
    };
    xhttp.open("DELETE", BASE_URL + "flight/index/" + encodeURIComponent(flight.id), true);
    xhttp.send();
});
