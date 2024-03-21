<?php
session_start();
require "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';

    if (isset($_POST['sitename'])) {
        $siteName = $_POST['sitename'];
        $companyID = $_SESSION["Company_ID"];
        $sql_search_site = "SELECT * FROM construction_site WHERE Site_Name = '$siteName' AND company_id = '$companyID'";
        $result_search_site = $database_connection->query($sql_search_site);

        if ($result_search_site->num_rows > 0) {
            $status['message'] = "Site Is Already Added";
        } else {
            $insert_site_sql = "INSERT INTO construction_site (Site_Name, company_id) VALUES ('$siteName', '$companyID')";

            if ($database_connection->query($insert_site_sql) === TRUE) {
                $status['status'] = 'success';
                $status['message'] = "Site Is Added Succesfully";
            } else {
                $status['message'] = "Error inserting data: " . $database_connection->error;
            }
        }
    }

    echo json_encode($status);
    exit;
}
?>