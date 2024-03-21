<?php
include("css/css-links.php");
require ("sidepanel.php");
require ("../Backend/database.php");

$user_role = $_SESSION["user_role"];
$company_id = $_SESSION["Company_ID"];

$siteId = $_GET['siteId'];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SafeX|Assigning Workers</title>
<script src="js/assign-helmet.js"></script>
<link rel="stylesheet" href="css/company.css">
</head>
<body>
<div class="main-container">
        <div class="upper-part col-md-6">
        <h1>Assigning Workers to Construction Site </h1>
            <form id="dynamicForm" action="../Backend/assign-helmet.php" method="post">
            <input type="hidden" name="siteId" value="<?php echo $siteId ?>">
            <div class="dynamicform">
            <h2>Select an option:</h2>
            <select id="dropdown" onchange="showFields()" name="assignment_type">
                <option value="">Select an option</option>
                <option value="Automatic">Automatic Assigning</option>
                <option value="Manual">Manual Assigning</option>
            </select>
            </div>
            
            </form>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Employee Name</th>
                    <th class="resizable">Position</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>
    <script src="js/notification-panel.js"></script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/assign-helmet.js"></script>
    <script>
        handleFormSubmit("dynamicForm");
    </script>
    
</body>
</html>