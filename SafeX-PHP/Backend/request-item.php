<?php
session_start(); 

require("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST['item'], $_POST['quantity'], $_POST['needed_date'], $_POST['special_note'])) {
        // Assign form data to variables
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $needed_date = $_POST['needed_date'];
        $special_note = $_POST['special_note'];

        // Retrieve Employee_ID from session variable
        if (isset($_SESSION['Employee_ID'])) {
            $employeeID = $_SESSION['Employee_ID'];

            // Query to get Company_ID and Site_ID based on Employee_ID
            $selectCompanySiteSql = "SELECT * FROM site_assigend_wokers WHERE Employee_ID = ?";
            $stmt = $database_connection->prepare($selectCompanySiteSql);
            $stmt->bind_param("i", $employeeID);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $companyID = $row['Company_ID'];
                    $siteID = $row['Site_ID'];

                    // Insert data into item_request table
                    $insertRequestSql = "INSERT INTO item_request (Employee_ID, Company_ID, Site_ID, Request_Item_Name, Request_Date, Request_Quantity, Special_Note)
                                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $database_connection->prepare($insertRequestSql);
                    $stmt->bind_param("iiissss", $employeeID, $companyID, $siteID, $item, $needed_date, $quantity, $special_note);
                    if ($stmt->execute()) {
                        $status['status'] = 'success';
                        $status['message'] = 'Item Request submitted successfully.';
                    } else {
                        $status['message'] = 'Failed to submit request.';
                    }
                } else {
                    $status['message'] = 'Employee not found or not assigned to a site.';
                }
            } else {
                $status['message'] = 'Error executing query.';
            }
        } else {
            $status['message'] = 'Employee ID not found in session.';
        }
    } else {
        $status['message'] = 'Missing parameters in the request.';
    }
    echo json_encode($status);
} else {
    $status['message'] = 'Invalid request method.';
    echo json_encode($status);
}
?>
