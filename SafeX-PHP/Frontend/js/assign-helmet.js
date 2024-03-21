document.addEventListener('DOMContentLoaded', function() {
    var assignButtons = document.querySelectorAll('.assign-btn');

    assignButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var siteId = this.getAttribute('data-userid');
            window.location.href = 'assign-helmet.php?siteId=' + siteId;
        });
    });
});

function updateTableData(selectedOption, position = null) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_table.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the response as JSON
            var data = JSON.parse(xhr.responseText);

            // Get the tableBody element
            var tableBody = document.getElementById("tableBody");

            // Clear previous table content
            tableBody.innerHTML = "";

            // Loop through the data and create new table rows
            data.forEach(function(row, index) {
                var newRow = document.createElement("tr");

                // Create table cells and append them to the new row
                var rowNumberCell = document.createElement("td");
                rowNumberCell.textContent = row.row_number;
                newRow.appendChild(rowNumberCell);

                var nameCell = document.createElement("td");
                nameCell.textContent = row.name;
                newRow.appendChild(nameCell);

                var positionCell = document.createElement("td");
                positionCell.textContent = row.position;
                newRow.appendChild(positionCell);

                var actionCell = document.createElement("td");
                if (row.action.startsWith("deleteWorker")) {
                    var actionButton = document.createElement("button");
                    actionButton.classList.add("btn", "btn-danger");
                    actionButton.setAttribute("onclick", row.action);
                    actionButton.textContent = "Delete";
                    actionCell.appendChild(actionButton);
                } else if (row.action.startsWith("manualAssignment")) {
                    var actionButton = document.createElement("button");
                    actionButton.classList.add("btn", "btn-danger");
                    actionButton.setAttribute("onclick", row.action);
                    actionButton.textContent = "Assign Worker";
                    actionCell.appendChild(actionButton);
                } else {
                    actionCell.innerHTML = row.action;
                }
                newRow.appendChild(actionCell);

                // Append the new row to the table body
                tableBody.appendChild(newRow);
            });
        }
    };
    var siteId = document.querySelector('input[name="siteId"]').value;
    var params = "siteId=" + encodeURIComponent(siteId) + "&selectedOption=" + encodeURIComponent(selectedOption);
    if (position) {
        params += "&position=" + encodeURIComponent(position);
    }
    xhr.send(params);
}

function showFields() {
    var selectedOption = document.getElementById("dropdown").value;
    var dynamicForm = document.getElementById("dynamicForm");
    var dynamicContent = dynamicForm.querySelector(".dynamicform"); // Selecting the div with class "dynamicform"

    // Clear previous content inside dynamicContent
    dynamicContent.innerHTML = "";
    updateTableData(selectedOption);

    if (selectedOption === "Automatic") {
        dynamicContent.innerHTML += '<input type="hidden" id="input1" name="operation" value ="Automatic">';
        dynamicContent.innerHTML += '<label for="NumofWorker">Number of Worker:</label>';
        dynamicContent.innerHTML += '<input type="number" id="input1" name="NumofWorker" required>';
        dynamicContent.innerHTML += '<label for="NumofSupervisor">Number of Supervisor:</label>';
        dynamicContent.innerHTML += '<input type="number" id="input2" name="NumofSupervisor" required>';    
        dynamicContent.innerHTML += '<input type="submit" value="Assign Worker">';
    } else if (selectedOption === "Manual") {
        dynamicContent.innerHTML += '<input type="hidden" id="input1" name="operation" value ="Manual">';
        var dropdownHTML = '<label for="position">Position: </label>';
        dropdownHTML += '<select id="position" name="position" required>';
        dropdownHTML += '<option value="worker">Construction Worker</option>';
        dropdownHTML += '<option value="supervisor">Supervisor</option>';
        dropdownHTML += '</select>';
        
        // Append the dropdown menu HTML to dynamicContent
        dynamicContent.innerHTML += dropdownHTML;
        dynamicContent.innerHTML += '<label for="employeeSearch">Search Employee:</label>';
        dynamicContent.innerHTML += '<input type="text" id="employeeSearch" name="employeeSearch" placeholder="Search..." required>';
        dynamicContent.innerHTML += '<button type="button" onclick="searchEmployee()">Search</button>';
    }

    

}