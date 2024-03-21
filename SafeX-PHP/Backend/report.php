<?php
session_start();
require "database.php";

if (!isset($_SESSION["Company_ID"])) {
    $_SESSION["Company_ID"] = 0;
}

if (!isset($_SESSION["Employee_ID"])) {
    $_SESSION["Employee_ID"] = 0;
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if(isset($_POST['id']) && isset($_POST["text"])){
        $id = $_POST["id"];
        $text = $_POST["text"];
        if($id == $_SESSION["Company_ID"]){
            reportSubmit($database_connection,"Report_Company_ID",$id,$text);
        }elseif($id == $_SESSION["Employee_ID"]){
            reportSubmit($database_connection,"Report_Employee_ID",$id,$text);
        }
    }
}

function reportSubmit($database_connection,$column,$id,$text){
    $erroReportinSQl = "INSERT INTO  issue_reporting ($column,Description) VALUES (?,?)";
                $stmt = $database_connection -> prepare($erroReportinSQl);
                if ($stmt === false) {
                    $status['message'] = 'Error Submitting Report';
                    echo json_encode($status);
                }
                $stmt -> bind_param("is",$id,$text);
                if($stmt -> execute()){
                    $status['status'] = 'success';
                    $status['message'] = 'Report Sent successfully';
                    echo json_encode($status);
                }else{
                    $status['message'] = 'Error Submitting Report';
                    echo json_encode($status);
                }   
                }
?>