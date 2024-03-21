<?php
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
require("../Backend/Other-Script/employee-details.php");

$user_role = $_SESSION["user_role"];
$searchQuery = "";

// Check if session variable is set to company_id or employee_id
if(isset($_SESSION['company_id']) && $user_role === 'company') {
    $company_id = $_SESSION['company_id'];
    $query = "SELECT * FROM employee WHERE Company_ID = $company_id";
} elseif (isset($_SESSION['Employee_ID']) && $user_role === 'employee') {
    $employeeID = $_SESSION["Employee_ID"];
    $query = "SELECT * FROM employee WHERE Employee_ID IN (SELECT Employee_ID FROM site_assigend_wokers WHERE Site_ID = (SELECT Site_ID FROM site_assigend_wokers WHERE Employee_ID = $employeeID))";
} else {
    $query = "SELECT * FROM employee";
}
$employees = $database_connection->query($query);

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee|SafeX</title>
    <link rel="stylesheet" href="css/employee.css">
    <style>
        body {margin-left: 250px;}
    </style>
  </head>

  <body>
    <div class="content text-center mt-5">
        
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6  mt-5">
                <form method="post">
                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="<?php echo $searchQuery; ?>">
                  <button class="btn btn-primary" type="submit" id="searchButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                  </button>
                </div>
                </form>
                <?php
                    if(isset($_POST['search'])) {
                        $searchQuery = $_POST['search']; // Retrieve search query from form submission
                    }

                    if(empty($searchQuery)) {
                        $employees = fetchAllEmployeeDetails($database_connection);
                    } else {
                        $employees = fetchSearchEmployeeDetails($searchQuery,$database_connection);
                    }
                ?>
                </div>
                <?php
                if(isset($user_role) && $user_role == 'company'){
                    echo '<div class="col-md-6 mt-5">';
                    echo '<button class="btn btn-primary" type="button" id="addbutton">Add Employee</button>';
                    echo '</div>';
                }
                ?>

                     
            </div>
    </div>
        <br>


        <div class="row text-center">
          <?php
           foreach($employees as $employee): ?>
            <div class="col-xl-3 col-sm-6 mb-5">
                <div class="bg-white rounded shadow-sm py-5 px-4">
                    <img src="<?php echo '../Backend/'.$employee['Employee_Pic'];?>" alt="<?php echo $employee['Name'];?>" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"><!--employee image-->
                    <h5 class="mb-0"><?php echo $employee['Name'];?></h5>
                    <div class="defaultbutton">
                    <?php
                        if(isset($user_role) && $user_role == 'employee'){
                                echo' <a href="livedefault.html">';
                                    echo '<button class="btn btn-primary" type="button" value="Live" id="livebutton">Live</button>';
                                echo'</a>';   
                        }
                        ?>
                        <a href="employee.php?id=<?php echo $employee['Employee_ID']; ?>">
                            <button class="btn btn-primary" type="button" value="View" id="viewbutton">View</button>
                        </a>     
                    </div>
                    
                </div>
            </div>
            <?php endforeach; ?>
          </div>
    </div>
    </div>

    <div class="add_new_employee" style="display: none;">
    <h2>Add Employee</h2>
        <form id="employeeForm" action="../Backend/employee.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="position">Position:</label><br>
            <select id="position" name="position" required>
                <option value="">Select Position</option>
                <option value="worker">Worker</option>
                <option value="supervisor">Supervisor</option>
                <option value="management">Management</option>
            </select><br><br>
            <label for="telephone">Telephone Number:</label><br>
            <input type="text" id="telephone" name="telephone" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required><br><br>
            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email"><br><br>
            <label for="employeePic">Employee Picture:</label><br>
            <input type="file" id="employeePic" name="employeePic" accept="image/*"><br>

            <div id="preview"></div><br>

            <input type="submit" value="Submit">
        </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var addButton = document.getElementById("addbutton");
    var addEmployeeDiv = document.querySelector(".add_new_employee");

    addButton.addEventListener("click", function() {
        addEmployeeDiv.style.display = "block";
    });
});
</script>
<script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("employeeForm");
    </script>
<script>
    document.getElementById('employeePic').addEventListener('change', function(event) {
    var preview = document.getElementById('preview');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.style.maxWidth = '200px'; 
        preview.innerHTML = ''; 
        preview.appendChild(img);
    };

    reader.readAsDataURL(file);
});
</script>
<?php
// Retrieve the Employee_ID from the URL parameter
if(isset($_GET['id'])) {
    $employeeID = $_GET['id'];
    
    // Fetch the details of the selected employee based on the Employee_ID
    $selectEmployeeSQL = "SELECT * FROM employee WHERE Employee_ID = $employeeID";
    $result = $database_connection->query($selectEmployeeSQL);
    
    // Check if employee details are found
    if ($result && $result->num_rows > 0) {
        $employee = $result->fetch_assoc();
?>

<!-- Display the employee details -->
<div class="selected-employee">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Employee image -->
                            <img src="<?php echo '../Backend/'.$employee['Employee_Pic'];?>" alt="<?php echo $employee['Name'];?>" class="img-fluid rounded-start" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Employee Details</h5><br>
                                <p class="card-text">Employee Id: <?php echo $employee['Employee_ID']; ?> </p>
                                <p class="card-text">Employee Name: <?php echo $employee['Name']; ?> </p>
                                <p class="card-text">Helmet Id: <?php echo ($employee['Assigned'] == 1) ? $helmetId : "N/A"; ?> </p>
                                <p class="card-text">Position: <?php echo $employee['Position']; ?> </p>
                                <p class="card-text">Contact No: <?php echo $employee['Telephone_No']; ?> </p>
                                <p class="card-text">Email: <?php echo $employee['Email_Address']; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    } else {
        echo "Employee details not found!";
    }
}
?>



</body>
</html>

