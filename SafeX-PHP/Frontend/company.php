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
    <link rel="stylesheet" href="css/company.css">
    <title>SafeX|Add New Company</title>
</head>
<body>
    <div class="main-container">
        <div class="upper-part col-md-6">
            <form action="" method="post">
                <div class="input-container">
                    <input type="text" name="search_company" id="input-box" placeholder="Company Name">
                    <button type="submit" name="search_company_button" id="search">Search</button>
                    <button name="add_new_company">Add New</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Company Name</th>
                    <th class="resizable">No Of Helmet</th>
                    <th class="resizable">Cloud Renwal Date</th>
                    <th class="resizable">Register Date</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row;
                $row_number=1;
                $company_query="SELECT * FROM company";
                if (isset($_POST['search_company_button']) && !empty($_POST['search_company'])) {
                    $search_company = $_POST['search_company'];
                    $company_query = "SELECT * FROM company WHERE Company_Name LIKE '%$search_company%'";
                }
                $company_result=mysqli_query($database_connection,$company_query);
                if($company_result->num_rows>0){
                    while($row=$company_result->fetch_assoc()){
                        echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Company_Name'] . '</td>
                        <td>' . $row['No_of_Helmet'] . '</td>
                        <td>' . $row['Cloud_Storage_Renew_Date'] . '</td>
                        <td>' . $row['Join_Date'] . '</td>
                        <td>
                            <a href="ViewAllCompanies.php?delete=' . $row['Company_ID'] . '"class="btn btn-danger">Delete</a>
                        </td>
                        </tr>';
                        $row_number++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="add_new_company_form">
    <h2>Register New Company</h2>
    <form action="../Backend/add-new-company.php" method="post" id="register_new_company">
        <label for="company_name">Company Name:</label><br>
        <input type="text" id="company_name" name="company_name"><br>
        
        <label for="no_of_helmet">Number of Helmets:</label><br>
        <input type="number" id="no_of_helmet" name="no_of_helmet"><br>
        
        <label for="cloud_storage_renew_date">Cloud Storage Renew Date:</label><br>
        <input type="date" id="cloud_storage_renew_date" name="cloud_storage_renew_date"><br>
        
        <label for="email_address">Email Address:</label><br>
        <input type="email" id="email_address" name="email_address"><br>
                
        <input type="submit" value="Register">
    </form>
    </div>

    <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("register_new_company");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


