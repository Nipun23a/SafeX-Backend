<?php 
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeX|Password</title>
</head>
<body>

        <!--main content-->
        <div class="content text-center mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6 mt-5">
                <div class="card text-center">
                  <div class="card-body">
                    <h4>Change Password</h4>
                    <form action="../Backend/password.php" method="post" id ="password-form">
                    <?php
                        if(isset($_SESSION['Employee_ID'])){
                            echo ' <div class="mt-4">
                            <input type="text" name="username" class="form-control" id="username" placeholder="New Username" required >
                          </div>';
                        }
                    ?>
                   
                      <div class="mt-4">
                        <input type="password" class="form-control" id="currentPassword" placeholder="Old Password" required name="currentPassword" value="">
                      </div>
                      <div class="mt-4">
                        <input type="password" class="form-control" id="newPassword" placeholder="New Password" required name="newPassword">
                      </div>
                      <div class="mt-4">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required name="confirmPassword">
                      </div>
                      <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script src="js/notification-panel.js"></script>
        <script>
        handleFormSubmit("password-form");
    </script>
    </body>
</html>