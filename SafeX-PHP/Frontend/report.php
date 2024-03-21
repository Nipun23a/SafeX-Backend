<?php 
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeX|Report</title>
    <link rel="stylesheet" type="text/css" href="css/message.css">
    <style>
        #report{
            color: black;
        }
    </style>
</head>
<body>
        <!--main content-->
        <div class="content text-center mt-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                        <h1 id="report">Report Isssue</h1>
                        <div class="card">
                            <div class="card-body">
                                <form action="../Backend/report.php" method="post" id="report-form">
                                    <div class="row">
                                        <input type="hidden" class="form-control" placeholder="Name" name="id" value=<?php if(isset($_SESSION["Employee_ID"])){
                                            $employeeID = $_SESSION["Employee_ID"];echo $employeeID;
                                        }elseif(isset($_SESSION["Company_ID"])){$companyID = $_SESSION["Company_ID"];echo $companyID;}
                                        ?>>
                                    <br>
                                    <div class="row">
                                        <textarea class="form-control" rows="5" id="message" placeholder="Issue" name="text"></textarea>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <input type="submit" value="Sent" class="btn btn-primary">
                                    </div>
                                </form><br>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/notification-panel.js"></script>
        <script>
        handleFormSubmit("report-form");
    </script>
    </body>
</html>
