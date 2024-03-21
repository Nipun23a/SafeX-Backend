<?php 
require("../Backend/database.php");
include("css/css-links.php");
require_once ("sidepanel.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeX|Message</title>
    <link rel="stylesheet" href="css/company.css">
</head>
<body>

    <!-- Navbar with Write Message button -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inbox</a> <!-- Inbox heading -->
            <button class="btn btn-primary ml-auto"  id="addbutton">Write a Message</button> <!-- Write Message button -->
        </div>
    </nav>

    <div class="table-container table-responsive">
        <!-- Table displaying messages -->
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Sender Name</th>
                    <th class="resizable">Date</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row;
                $row_number=1;
                if(isset($_SESSION["Company_ID"])){
                    $companyID = $_SESSION['Company_ID'];
                    $company_query = "SELECT messaging.*,employee.Name FROM messaging JOIN employee ON messaging.Sender_Employee_ID = employee.Employee_ID WHERE Receiver_Company_ID ='$companyID' ORDER BY messaging.Timestamp DESC";
                }
                $company_result=mysqli_query($database_connection,$company_query);
                if($company_result->num_rows>0){
                    while($row=$company_result->fetch_assoc()){
                        echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Name'] . '</td>
                        <td>' . $row['Timestamp'] . '</td>
                        <td>
                            <a href=""class="btn btn-danger">View</a>
                            <a href=""class="btn btn-danger">Delete</a>
                        </td>
                        </tr>';
                        $row_number++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Message Form -->
    <div class="content text-center mt-5" id="message-form-container" style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                
                <div class="card">
                    <div class="card-body" >
                        <form method="post" action="../Backend/message.php" id="message-form" >
                        <h4 class="text-center">Write a Message</h4> <!-- Centered heading -->
                        <br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="To" name="receiver">
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" placeholder="From" name="from" value="<?php
                                        if (isset($_SESSION["Employee_ID"])) {
                                            $employeeID = $_SESSION["Employee_ID"];
                                            echo $employeeID;
                                        } elseif (isset($_SESSION["Company_ID"])) {
                                            $companyID = $_SESSION["Company_ID"];
                                            echo $companyID;
                                        }
                                    ?>">
                                </div>
                            </div><br>
                            <div class="row">
                                <textarea class="form-control" rows="5" id="message" placeholder="Message" name="message-body" required></textarea>
                            </div>
                            <br>
                            <div class="row">
                                <input type="submit" class="btn btn-primary" value="Send">
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
        handleFormSubmit("message-form");
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var addButton = document.getElementById("addbutton");
    var addEmployeeDiv = document.getElementById("message-form-container");

    addButton.addEventListener("click", function() {
        addEmployeeDiv.style.display = "block";
    });
});
</script>
    </script>
</body>
</html>