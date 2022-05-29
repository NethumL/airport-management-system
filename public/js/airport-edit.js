const BASE_URL = document.head.querySelector("[name=BASE_URL][content]").content;
const alertContainer = document.getElementById("alert-container");

const filterForm = document.getElementById("filter-form");
const filterFormFields = filterForm.querySelectorAll("input");

let sortOrder = null;
const table = document.getElementById("airport-table");

let airport = null;
const updateForm = document.getElementById("update-form");
const updateFormFields = updateForm?.querySelectorAll("input,select,textarea");
const clearButton = document.getElementById("clear-button");
const deleteButton = document.getElementById("delete-button");

const resetUpdateForm = () => {
    updateForm.reset();
    airport = null;
}

const showAlert = (message, style) => {
    const div = document.createElement("div");
    div.classList.add("alert", "alert-" + style, "mx-4");
    div.textContent = message;
    div.id = "update-airport-message";
    alertContainer.appendChild(div);
    setTimeout(deleteAlert, 3000);
}

const deleteAlert = () => {
    const alertDiv = document.getElementById("update-airport-message");
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
            response.forEach(airport => {
                const tr = document.createElement("tr");
                tr.dataset.id = airport.id;
                const nameTd = document.createElement("td");
                nameTd.textContent = airport.name;
                tr.appendChild(nameTd);
                const editTd = document.createElement("td");
                editTd.innerHTML = "<button class=\"btn btn-warning edit-button\"><i class=\"fa-solid fa-pen-to-square fa-1x\"></i></button>"
                tr.appendChild(editTd);
                tbody.appendChild(tr);
            });
        }
    }
    xhttp.open("GET", BASE_URL + "airport/search" + query, true);
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

const editAirport = (row) => {
    resetUpdateForm();
    const id = row.dataset.id;
    const [ {textContent: name} ] = row.children;

    updateFormFields[0].value = name;
    airport = { id, name };
};

table.querySelector("tbody").addEventListener("click", e => {
    const row = e.target.closest("tr");
    if ((e.target.nodeName === "I" || e.target.nodeName === "BUTTON"))
        editAirport(row);
});

updateForm?.addEventListener("submit", e => {
    e.preventDefault();

    if (!airport)
        return;

    if (airport.name === updateFormFields[0].value) {
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
                    row.children[0].textContent = response.name;
                }
                resetUpdateForm();
                showAlert("Airport successfully updated", "success");
            } else {
                showAlert("Airport update failed", "danger");
            }
        }
    };
    xhttp.open("POST", BASE_URL + "airport/edit/" + encodeURIComponent(airport.id), true);
    xhttp.send(new FormData(updateForm));
});

clearButton?.addEventListener("click", resetUpdateForm);

deleteButton?.addEventListener("click", () => {
    if (!airport)
        return;

    const xhttp = new XMLHttpRequest();
    xhttp.withCredentials = true;
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const row = Array.from(table.querySelectorAll("tbody tr")).find(row => row.dataset.id == airport.id);
            if (row) {
                row.remove();
            }
            resetUpdateForm()
        }
    };
    xhttp.open("DELETE", BASE_URL + "airport/edit/" + encodeURIComponent(airport.id), true);
    xhttp.send();
});
