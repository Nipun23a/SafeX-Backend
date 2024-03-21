<?php
require ("../Backend/database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST['employeeName'])) {
        $employeeID = $_POST['employeeName'];
        $selectCompanyIDSql = "SELECT Company_ID FROM employee WHERE Employee_ID = ?";
        $stmt = $database_connection->prepare($selectCompanyIDSql);
        $stmt->bind_param("i", $employeeID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $companyID = $row['Company_ID'];
                $leaveStartDate = $_POST['fromDate'];
                $leaveEndDate = $_POST['toDate'];
                $leaveDescription = $_POST['reason'];
                if (!empty($leaveStartDate) && !empty($leaveEndDate) && !empty($leaveDescription)) {
                    $insertLeaveReportSql = "INSERT INTO leave_reporting (Company_ID, Employee_ID, Leave_Start_Date, Leave_End_Date, Leave_Description) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $database_connection->prepare($insertLeaveReportSql);
                    $stmt->bind_param("iisss", $companyID, $employeeID, $leaveStartDate, $leaveEndDate, $leaveDescription);
                    if ($stmt->execute()) {
                        $status['status'] = 'success';
                        $status['message'] = 'Leave report submitted successfully.';
                    } else {
                        $status['message'] = "Error inserting leave report: " . $database_connection->error;
                    }
                } else {
                    $status['message'] = "Leave start date, end date, and description are required.";
                }
            } else {
                $status['message'] = "Company ID not found for the selected employee.";
            }
        } else {
            $status['message'] = "Error executing query to retrieve company ID: " . $database_connection->error;
        }
    } else {
        $status['message'] = "Employee ID not found in the form submission.";
    }

    echo json_encode($status);
}
?>