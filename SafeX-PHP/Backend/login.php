<?php
require "database.php";

$errors = array();
session_start();

// Login to the system
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($database_connection, $_POST['username']);
        $password = $_POST['password'];

        // Check if there is a username and password found on the company table
        $companySql = "SELECT Company_ID, Password_Hash FROM company WHERE Company_Name = ?";
        $companyStmt = $database_connection->prepare($companySql);
        $companyStmt->bind_param("s", $username);
        $companyStmt->execute();
        $companyResult = $companyStmt->get_result();

        // Check if the username and password are found in the employee table
        $employeeSql = "SELECT * FROM employee WHERE Username = ?";
        $employeeStmt = $database_connection->prepare($employeeSql);
        $employeeStmt->bind_param("s", $username);
        $employeeStmt->execute();
        $employeeResult = $employeeStmt->get_result();

        if ($companyResult->num_rows > 0) {
            $row = $companyResult->fetch_assoc();
            $hashed_password = $row['Password_Hash'];
            if (password_verify($password, $hashed_password)) {
                $user_id = $row['Company_ID'];
                $_SESSION["Company_ID"] = $user_id;
                $_SESSION['user_role'] = 'company';
                header("Location: dashboard.php");
                exit(); // Exit after redirection
            } else {
                array_push($errors, "Username or Password is Incorrect");
            }
        } elseif ($employeeResult->num_rows > 0) {
            $row = $employeeResult->fetch_assoc();
            $hashed_password = $row['Password_Hash'];
            if (password_verify($password, $hashed_password)) {
                $user_id = $row['Employee_ID'];
                $_SESSION["Employee_ID"] = $user_id; // Set employee ID in session
                $_SESSION['user_role'] = 'employee';
                header("Location: dashboard.php");
                exit(); // Exit after redirection
            } else {
                array_push($errors, "Username or Password is Incorrect");
            }
        } elseif ($username == "admin" && $password == "admin123") {
                $_SESSION['user_role'] = 'admin';
                header("Location: dashboard.php");
                exit();
        } else {
            array_push($errors, "Username does not exist");
        }
    } else {
        array_push($errors, "Username and Password are required");
    }
}
?>