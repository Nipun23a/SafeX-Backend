function manualAssignment(siteId, employeeId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assign-worker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("site_ID=" + siteId + "&employee_ID=" + employeeId);
}

function deleteItem(employeeId, phpFile, parameterName) {           // API to Delete item from the table
    var xhr = new XMLHttpRequest();
    xhr.open("GET", phpFile + "?" + parameterName + "=" + employeeId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle response from PHP file
            console.log(xhr.responseText); // Or do something else
        }
    };
    xhr.send();
}