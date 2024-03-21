<?php
session_start();
require "database.php";

$status = array(
    'status' => 'error',
    'message' => ''
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['receiver']) && isset($_POST['from']) && isset($_POST['message-body'])) {
        $receiver = $_POST['receiver'];
        $from = $_POST['from'];
        $message = $_POST['message-body'];
        
        if (isset($_SESSION["Company_ID"]) && $from == $_SESSION["Company_ID"]) {
            $selectWorkerSql = "SELECT * FROM employee WHERE Company_ID = ? AND Name = ? AND Position = 'supervisor'";
            $stmt = $database_connection->prepare($selectWorkerSql);
            $stmt->bind_param("is", $from, $receiver);
            if ($stmt->execute()) {
                $resultWorker = $stmt->get_result();
                if ($resultWorker->num_rows > 0) {
                    $rowEmployee = $resultWorker->fetch_assoc();
                    $receiverID = $rowEmployee['Employee_ID'];
                    
                    $insertMessageSql = "INSERT INTO messaging(Sender_Company_ID, Receiver_Employee_ID, Message_Body) VALUES (?, ?, ?)";
                    $stmt = $database_connection->prepare($insertMessageSql);
                    $stmt->bind_param("iis", $from, $receiverID, $message);
                    if ($stmt->execute()) {
                        $status['status'] = 'success';
                        $status['message'] = 'Message Sent Successfully';
                    } else {
                        $status['message'] = "Message Sent Fail: " . $database_connection->error;
                    }
                } else {
                    $status['message'] = "No supervisor found with the given name in the company";
                }
            } else {
                $status['message'] = "Error executing query: " . $database_connection->error;
            }
        } elseif (isset($_SESSION["Employee_ID"]) && $from == $_SESSION["Employee_ID"]) {
            // Check if the receiver is within the same company and has a position in supervisor or management
            $selectReceiverSql = "SELECT e.*, c.Company_Name,c.Company_ID
                                  FROM employee e 
                                  JOIN company c ON e.Company_ID = c.Company_ID 
                                  WHERE c.Company_Name = ? ";
            $stmt = $database_connection->prepare($selectReceiverSql);
            $stmt->bind_param("s", $receiver);
            if ($stmt->execute()) {
                $resultReceiver = $stmt->get_result();
                if ($resultReceiver->num_rows > 0) {
                    $rowEmployee = $resultReceiver->fetch_assoc();
                    $receiverID = $rowEmployee['Company_ID'];
                    
                    // Insert the message into the messaging table
                    $insertMessageSql = "INSERT INTO messaging(Sender_Employee_ID, Receiver_Company_ID, Message_Body) VALUES (?, ?, ?)";
                    $stmt = $database_connection->prepare($insertMessageSql);
                    $stmt->bind_param("iis", $from, $receiverID, $message);
                    if ($stmt->execute()) {
                        $status['status'] = 'success';
                        $status['message'] = 'Message Sent Successfully';
                    } else {
                        $status['message'] = "Message Sent Fail: " . $database_connection->error;
                    }
                } else {
                    $selectReceiverSql = "SELECT e.Name AS Receiver_Name FROM employee e JOIN company c ON e.Company_ID = c.Company_ID WHERE e.Company_ID = ? AND e.Name = ? AND e.Position IN('supervisor','management') ";
                    $stmt = $database_connection -> prepare($selectReceiverSql);
                    $stmt->bind_param("s", $receiver);
                    if ($stmt->execute()) {
                        $resultReceiver = $stmt->get_result();
                        if($resultReceiver -> num_rows>0){
                            $rowEmployee = $resultReceiver->fetch_assoc();
                            $receiverID = $rowEmployee['Employee_ID'];
                            $insertMessageSql = "INSERT INTO messaging(Sender_Employee_ID, Receiver_Employee_ID, Message_Body) VALUES (?, ?, ?)";
                            $stmt = $database_connection->prepare($insertMessageSql);
                            $stmt->bind_param("iis", $from, $receiverID, $message);
                            if ($stmt->execute()) {
                                $status['status'] = 'success';
                                $status['message'] = 'Message Sent Successfully';
                            } else {
                                $status['message'] = "Message Sent Fail: " . $database_connection->error;
                            }
                        }
                    }else {
                        $status['message'] = "Receiver is not found";
                    }
                }
            } else {
                $status['message'] = "Message Sent Fail: " . $database_connection->error;
            }
        } else {
            $status['message'] = "Invalid sender type";
        }
    } else {
        $status['message'] = "Missing parameters in the request";
    }
}

echo json_encode($status);
?>