<?php
session_start();
require "database.php";
require "Other-Script/random-string-generating.php";
require "Other-Script/email-sender.php";

$status = array();
$status['status'] = 'error';
$status['message'] = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["Company_ID"])) {
        $employeeName = $_POST["name"];
        $companyID = $_SESSION["Company_ID"];
        $position = $_POST["position"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];

        // Check for file upload error
        if ($_FILES["employeePic"]["error"] != UPLOAD_ERR_OK) {
            $status['message'] = 'File upload error: ' . $_FILES["employeePic"]["error"];
            echo json_encode($status);
            exit();
        }

        // Sanitize user input
        $employeeName = mysqli_real_escape_string($database_connection, $employeeName);
        $position = mysqli_real_escape_string($database_connection, $position);
        $telephone = mysqli_real_escape_string($database_connection, $telephone);
        $email = mysqli_real_escape_string($database_connection, $email);

        // File upload
        $targetDir = "uploads/";
        $fileName = basename($_FILES["employeePic"]["name"]);
        $employeeFileName = str_replace(" ", "_", $employeeName) . '_' . $fileName;
        $targetFilePath  = $targetDir . $employeeFileName;

        // Define password hash with a default value
        $passwordHash = '';

        if (move_uploaded_file($_FILES["employeePic"]["tmp_name"], $targetFilePath)) {
            // Generate random username and password for supervisor/management positions
            $username = '';
            $password = '';
            if ($position == 'supervisor' || $position == 'management') {
                $username = generateRandomString(8);
                $password = generateRandomString(10);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO employee (Name, Position, Telephone_No, Company_ID, Employee_Pic, Username, Password_Hash, Email_Address)
                            VALUES ('$employeeName', '$position', '$telephone', '$companyID', '$targetFilePath', '$username', '$passwordHash', '$email')";
                if ($database_connection->query($insertQuery)) {
                    if(employeeEmailSender($email, $employeeName, $username, $password)){
                        $status['status'] = 'success';
                        $status['message'] = "Employee Registered Successfully and Email Sent";
                    }else{
                        $status['message'] = "Message could not be sent. Mailer Error";
                    }   

                } else {
                    $status['message'] = "Failed to insert new data: " . $database_connection->error;
                }            
            }elseif($position == 'worker' ){
                $insertQuery = "INSERT INTO employee (Name, Position, Telephone_No, Company_ID, Employee_Pic, Username, Password_Hash, Email_Address)
                            VALUES ('$employeeName', '$position', '$telephone', '$companyID', '$targetFilePath', '$username', '$passwordHash', '$email')";
                if ($database_connection->query($insertQuery)) {
                    $status['status'] = 'success';
                    $status['message'] = "Employee Registered Successfully";
                } else {
                    $status['message'] = "Failed to insert new data: " . $database_connection->error;
                }
            }else {
                $status['message'] = "Failed to insert new data: " . $database_connection->error;
            }
        } else {
            $status['message'] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $status['message'] = "Session Company_ID not set.";
    }
} else {
    $status['message'] = "Invalid request method.";
}

echo json_encode($status);
exit();
?>