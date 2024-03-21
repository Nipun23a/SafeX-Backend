<?php 
require("../Backend/database.php");
include("css/css-links.php");
require_once ("sidepanel.php");
require_once("../Backend/database.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave|SafeX</title>
</head>
<body>
<div class="content text-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leave Form</h5><br>

                        <form action="../Backend/leave.php" method="POST" id="leave-form">
                            <div class="container mt-3">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                    <?php
                                    $employeeID = $_SESSION['Employee_ID']; // Assuming the session variable storing the Employee_ID is 'Employee_ID'

                                    // Step 2: Query the site ID of the logged-in user from the site_assigned_workers table
                                    $selectSiteIDSql = "SELECT Site_ID FROM site_assigend_wokers WHERE Employee_ID = ?";
                                    $stmt = $database_connection->prepare($selectSiteIDSql);
                                    $stmt->bind_param("i", $employeeID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        $siteID = $row['Site_ID'];
                                        $selectEmployeesSql = "SELECT Employee_ID, Name FROM employee WHERE Employee_ID IN 
                                                                (SELECT Employee_ID FROM site_assigend_wokers WHERE Site_ID = ?)";
                                        $stmt = $database_connection->prepare($selectEmployeesSql);
                                        $stmt->bind_param("i", $siteID);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        echo '<select class="form-select" id="employeeSelect" name="employeeName" required>';
                                        echo '<option value="">Select Employee</option>';
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['Employee_ID'] . '">' . $row['Name'] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<p>No site assigned for the logged-in user.</p>';
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="container">
                                        <div class="row">
                                            <label for="dateFrom" class="col-1 col-md-2 col-form-label"></label>
                                            <div class="col-5 col-md-10">
                                                <input type="date" class="form-control" id="dateFrom" name="fromDate" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="container">
                                        <div class="row">
                                            <label for="dateTo" class="col-1 col-md-2 col-form-label"></label>
                                            <div class="col-5 col-md-10">
                                                <input type="date" class="form-control" id="dateTo" name="toDate" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reason content -->
                            <label for="comment"></label>
                            <textarea class="form-control" rows="5" id="comment" name="reason" placeholder="Reason" required></textarea>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/notification-panel.js"></script>
        <script>
        handleFormSubmit("leave-form");
    </script>
</body>
</html>

