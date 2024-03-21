<?php
require "database.php";
session_start();
$status = array();
$status['status'] = 'error';
$status['message'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_SESSION['Employee_ID']) && isset($_POST['username']) && isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])){
        $employeeID = $_SESSION['Employee_ID'];
        $username = $_POST['username'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if($newPassword != $confirmPassword){
            $status['message'] = 'Password Mismatch';
            echo json_encode($status);
            exit();
        }

        $checkEmployeeCurrentPassword = "SELECT Password_Hash FROM employee WHERE Employee_ID = ?";
        $stmt = $database_connection->prepare($checkEmployeeCurrentPassword);
        $stmt->bind_param("i", $employeeID);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $oldPasswordHash = $row['Password_Hash'];

                if(password_verify($currentPassword, $oldPasswordHash)){
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePasswordSql = "UPDATE employee SET Username = ?, Password_Hash = ? WHERE Employee_ID = ?";
                    $stmt = $database_connection->prepare($updatePasswordSql);
                    $stmt->bind_param("ssi", $username, $newPasswordHash, $employeeID);
                    
                    if($stmt->execute()){
                        $status['status'] = 'success';
                        $status['message'] = 'Password updated successfully';
                    } else {
                        $status['message'] = "Failed to update password: " . $database_connection->error;
                    }
                } else {
                    $status['message'] = "Incorrect current password";
                }
            } else {
                $status['message'] = "Employee not found";
            }
        } else {
            $status['message'] = "Error executing query: " . $database_connection->error;
        }
    } elseif(isset($_SESSION['Company_ID']) && isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])){
        $companyID = $_SESSION['Company_ID'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if($newPassword != $confirmPassword){
            $status['message'] = 'Password Mismatch';
            echo json_encode($status);
            exit();
        }

        $checkCompanyCurrentPassword = "SELECT Password_Hash FROM company WHERE Company_ID = ?";
        $stmt = $database_connection->prepare($checkCompanyCurrentPassword);
        $stmt->bind_param("i", $companyID);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $oldPasswordHash = $row['Password_Hash'];

                if(password_verify($currentPassword, $oldPasswordHash)){
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePasswordSql = "UPDATE company SET Password_Hash = ? WHERE Company_ID = ?";
                    $stmt = $database_connection->prepare($updatePasswordSql);
                    $stmt->bind_param("si", $newPasswordHash, $companyID);
                    
                    if($stmt->execute()){
                        $status['status'] = 'success';
                        $status['message'] = 'Password updated successfully';
                    } else {
                        $status['message'] = "Failed to update password: " . $database_connection->error;
                    }
                } else {
                    $status['message'] = "Incorrect current password";
                }
            } else {
                $status['message'] = "Company not found";
            }
        } else {
            $status['message'] = "Error executing query: " . $database_connection->error;
        }
    } else {
        $status['message'] = "Missing parameters in the request". $database_connection->error;
    }
    echo json_encode($status);
}
?>