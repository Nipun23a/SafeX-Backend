<?php
function fetchAllEmployeeDetails($database_connection){
    if ($_SESSION["user_role"] === "company") {
        $companyID = $_SESSION["Company_ID"];
        $getEmployeesSQL = "SELECT * FROM employee WHERE Company_ID = '$companyID'";
    } else if ($_SESSION["user_role"] === "employee") {
        $employeeID = $_SESSION["Employee_ID"];
        $getEmployeesSQL = "SELECT * FROM employee WHERE Employee_ID IN (SELECT Employee_ID FROM site_assigend_wokers WHERE Site_ID IN (SELECT Site_ID FROM site_assigend_wokers WHERE Employee_ID = '$employeeID'))";
    }

    $getEmployeesQuery = mysqli_query($database_connection, $getEmployeesSQL);
    if(mysqli_num_rows($getEmployeesQuery) > 0) {
        $employees = array();
        while($row = mysqli_fetch_assoc($getEmployeesQuery)) {
            $employees[]  = $row;
        }
    } else {
        $employees = array();
        echo "No Employees Found";
    }
    return $employees;
}

function fetchSearchEmployeeDetails($searchEmployee, $database_connection){
    if ($_SESSION["user_role"] === "company") {
        $companyID = $_SESSION["Company_ID"];
        $getSearchEmployeeSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Name = '$searchEmployee'";
    } else if ($_SESSION["user_role"] === "employee") {
        $employeeID = $_SESSION["Employee_ID"];
        $getSearchEmployeeSql = "SELECT * FROM employee WHERE Employee_ID IN (SELECT Employee_ID FROM site_assigned_workers WHERE Site_ID IN (SELECT Site_ID FROM site_assigned_workers WHERE Employee_ID = '$employeeID')) AND Name = '$searchEmployee'";
    }

    $getSearchEmployeeQuery = mysqli_query($database_connection, $getSearchEmployeeSql);
    if(mysqli_num_rows($getSearchEmployeeQuery) > 0) {
        $employees = array();
        while($row = mysqli_fetch_assoc($getSearchEmployeeQuery)) {
            $employees[]  = $row;
        }
    } else {
        $employees = array();
        echo "No Employees Found";
    }
    return $employees;
}
?>