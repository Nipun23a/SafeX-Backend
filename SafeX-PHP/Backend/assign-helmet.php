<?php
session_start();
require "database.php";
$companyID = $_SESSION["Company_ID"];
$siteId = $_POST['siteId'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST['operation'])) {
        $assignment_type = $_POST['operation'];
        if ($assignment_type =='Automatic') {
            automaticAssignment($companyID,$database_connection,$siteId);
        } elseif ($assignment_type == 'Manual') {
            manualAssignment();
            $status['status'] = 'success';
            $status['message'] = 'Manual Assignment Successful';
            echo json_encode($status);
            echo "Succesfully Adde42";
            exit();
        } else {
            /*$status['message'] = 'Invalid assignment type selected';
            echo json_encode($status);*/
            echo "Invalid assignment type selected1"; 
        }
    } else {
       /* $status['message'] = 'Please select an assignment type';
        echo json_encode($status);*/
        echo "Invalid assignment type selected23"; 
    }
}

// Function for automatic assignment
function automaticAssignment($companyID,$database_connection,$siteId) {
    if (isset($_POST['NumofWorker']) && isset($_POST['NumofSupervisor'])) {
        $workers = $_POST['NumofWorker'];
        $supervisors = $_POST['NumofSupervisor'];
        $selectWorkersSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Assigned = 0 AND Position = 'worker' LIMIT $workers";
        $resultWorkers = $database_connection->query($selectWorkersSql);
        if ($resultWorkers == false) {
            $status['message'] = "Error executing query: " . $database_connection->error;;
            echo json_encode($status);
            exit();
        }
        $selectSupervisiorSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Assigned = 0 AND Position = 'supervisor' LIMIT $supervisors";
        $resultSupervisiors = $database_connection->query($selectSupervisiorSql);
        if (!$database_connection->query($selectSupervisiorSql)) {
            $supervisorSuccess = false;
            $status['message'] = "Error adding worker:" . $database_connection->error ;
            echo json_encode($status);
            exit();
            
        }
        $workerSuccess = true;
        $supervisorSuccess = true;
    
        while ($rowWorker = $resultWorkers->fetch_assoc()) {
            $workerId = $rowWorker['Employee_ID'];
            $insertWorkerSql = "INSERT INTO site_assigend_wokers  (Company_ID, Employee_ID, Site_ID) VALUES ('$companyID', '$workerId', '$siteId')";
            $resultInsertWorkers = $database_connection->query($insertWorkerSql);
            if ($resultInsertWorkers == false) {
                $status['message'] = "Error executing query: " . $database_connection->error;;
                echo json_encode($status);
                exit();
            }
        }
    
        while ($rowSupervisor = $resultSupervisiors->fetch_assoc()) {
            $supervisorId = $rowSupervisor['Employee_ID'];
            $insertSupervisorSql = "INSERT INTO site_assigend_wokers  (Company_ID, Employee_ID, Site_ID) VALUES ('$companyID', '$supervisorId','$siteId')";
            if ($supervisors > 0 && !$database_connection->query($insertSupervisorSql)) {
                $supervisorSuccess = false;
                $status['message'] = "Error adding supervisor: " . $database_connection->error ;
                echo json_encode($status);
            }
        }
        if ($workerSuccess && $supervisorSuccess) {
            $status['status'] = 'success';
            $status['message'] = 'Auto Assignment Successful';
            echo json_encode($status);
            exit();
        } else {
            $status['message'] = 'Error Occured';
            echo json_encode($status);
            exit();
        }
    }
}

// Function for manual assignment
function manualAssignment() {

}
?>
