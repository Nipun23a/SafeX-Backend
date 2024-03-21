<?php
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
$user_role = $_SESSION["user_role"];
$company_id = $_SESSION["Company_ID"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Add New Construction Site</title>
    <link rel="stylesheet" href="css/company.css">
</head>
<body>
<div class="main-container">
        <div class="upper-part col-md-6">
            <form action="" method="post">
                <div class="input-container">
                    <input type="text" name="search_constructionsite" id="input-box" placeholder="Constructionsite Name">
                    <button type="submit" name="search_constructionsite_button" id="search">Search</button>
                    <button name="add_new_constructionsite">Add New</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Construction Site</th>
                    <th class="resizable">Number of Helmet</th>
                    <th class="resizable">Number of Workers</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $row;
            $row_number = 1;
            $company_query = "SELECT * FROM company";

            // Initialize $construction_query with a default query
            $construction_query = "SELECT * FROM construction_site WHERE company_id = '$company_id'";

            if (isset($_POST['search_constructionsite_button']) && !empty($_POST['search_constructionsite'])) {
                $search_constructionSite = $_POST['search_constructionsite'];
                $construction_query = "SELECT * FROM construction_site WHERE Site_Name LIKE '%$search_constructionSite%' AND company_id = '$company_id'";
            }

            $construction_result = mysqli_query($database_connection, $construction_query);

            if ($construction_result->num_rows > 0) {
                while ($row = $construction_result->fetch_assoc()) {
                    $numWorkers = $row['Number_of_workers'] ?? 0;
                    $assignedHelmets = $row['Assigned_Helmets'] ?? 0;
                    echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Site_Name'] . '</td>
                        <td>' .$numWorkers . '</td>
                        <td>' . $assignedHelmets. '</td>
                        <td>
                            <a href="construction-site.php?delete=' . $row['site_id'] . '"class="btn btn-danger">Delete</a>
                            <a href="#" data-userid="'.$row['site_id'].'" class="btn btn-primary assign-btn">Assign</a>
                        </td>
                        </tr>';
                    $row_number++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="add_new_site_form">
        <form action="../Backend/construction-site.php" method="post" id="register_new_construction">
            <label for="sitename">Construction Site Name:</label><br>
            <input type="text" id="name" name="sitename" required><br><br>

            <input type="submit" value="Add Construction Site" name="add_site">
        </form>
    </div>
    <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("register_new_construction");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/assign-helmet.js"></script>
    
</body>
</html>