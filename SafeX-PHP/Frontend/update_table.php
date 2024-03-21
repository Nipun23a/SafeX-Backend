<?php
// Prevent any output before sending the JSON data
ob_start();
session_start();
require "../Backend/database.php";

$companyID = $_SESSION["Company_ID"];
$siteId = $_POST['siteId'];
$selectedOption = $_POST['selectedOption'];
$position = isset($_POST['position']) ? $_POST['position'] : null;

$row;
if ($selectedOption === "Automatic") {
    // Query for automatic assignment
    $assigned_workers_query = "SELECT e.Name, e.Position, saw.Site_ID, saw.Employee_ID
                                FROM site_assigend_wokers saw
                                JOIN employee e ON saw.Employee_ID = e.Employee_Id
                                WHERE saw.Site_ID = '$siteId'
                                ORDER BY e.Name";
} elseif ($selectedOption === "Manual") {
    $assigned_workers_query = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Assigned = 0";
}

$assigned_workers_result = $database_connection->query($assigned_workers_query);

$data = array();
$row_number = 1;

if ($assigned_workers_result->num_rows > 0) {
    while ($row = $assigned_workers_result->fetch_assoc()) {
        $buttonHTML = '';
        if ($selectedOption === "Automatic") {
            $buttonHTML = 'deleteWorker(' . $siteId . ', ' . $row['Employee_ID'] . ')';
        } elseif ($selectedOption === "Manual") {
            $buttonHTML = 'manualAssignment(' . $siteId . ', ' . $row['Employee_ID'] . ')';
        }

        $data[] = array(
            'row_number' => $row_number,
            'name' => $row['Name'],
            'position' => $row['Position'],
            'action' => $buttonHTML
        );
        $row_number++;
    }
} else {
    $data[] = array('message' => 'No workers found.');
}

// Return the data as JSON
echo json_encode($data);

ob_end_flush();
exit();
?>
