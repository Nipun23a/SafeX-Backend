<?php
require "database.php";
require "Other-Script/random-string-generating.php";
require "Other-Script/email-sender.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST["company_name"]) && isset($_POST["no_of_helmet"]) && isset($_POST["cloud_storage_renew_date"]) && isset($_POST["email_address"])) {
        $companyName = $_POST["company_name"];
        $noOfHelmet = $_POST["no_of_helmet"];
        $cloudStorageRenewDate = $_POST["cloud_storage_renew_date"];
        $companyEmail = $_POST["email_address"];
        $randomPassword = generateRandomString(10);
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);
        $companySql = "SELECT * FROM company WHERE Company_Name = ? AND  Email_Address = ?";
        $companyResult = $database_connection->prepare($companySql);
        $companyResult->bind_param("ss", $companyName, $companyEmail);
        $companyResult->execute();
        $resultCheck = $companyResult->get_result();
        if ($resultCheck->num_rows > 0) {
            $status['message'] = "Company Already Existed";
            echo json_encode($status);
            exit;
        }
        $newCompanySql = "INSERT INTO company (Company_Name,No_of_Helmet, Cloud_Storage_Renew_Date, Email_Address, Password_Hash) VALUES (?,?,?,?,?)";
        $stmt = $database_connection->prepare($newCompanySql);
        if ($stmt === false) {
            die("Error: " . $newCompanySql . "<br>" . $database_connection->error);
        }
        $stmt->bind_param("sisss", $companyName,  $noOfHelmet, $cloudStorageRenewDate, $companyEmail, $hashedPassword);
        if ($stmt->execute()) {
            $companyID = $database_connection->insert_id;
            $unAssignHelmetQuery = "SELECT * FROM helmet WHERE Assigned = 0 LIMIT $noOfHelmet";
            $result = $database_connection->query($unAssignHelmetQuery);
            if ($result->num_rows < $noOfHelmet) {
                $status['message'] = "Not Enough Helmet to Assign";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $helmetID = $row["Helmet_ID"];
                    $assignHelmetQuery = "UPDATE helmet SET Assigned = 1 WHERE Helmet_ID = $helmetID";
                    $updateResult = $database_connection->query($assignHelmetQuery);
                    if ($updateResult) {
                        $addingHelmetSql = "INSERT INTO helmet_assignment(Company_ID, Helmet_ID) VALUES (?, ?)";
                        $addingStmt = $database_connection->prepare($addingHelmetSql);
                        $addingStmt->bind_param("ii", $companyID, $helmetID);
                        if ($addingStmt->execute()) {
                            $status['status'] = 'success';
                            $status['message'] = "Company Registered Successfully";
                        } else {
                            $status['message'] = "Error Occurred While Registering";
                        }
                    }
                }
            }
        }
    }
    echo json_encode($status);
}


?>