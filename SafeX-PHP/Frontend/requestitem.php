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
    <title>Request Item|SafeX</title>
</head>
<body>
<div class="content text-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Request Item</h5><br>
                        <form method="POST" action="../Backend/request-item.php" id="request-form"> <!-- Assuming submit_form.php is the PHP file to handle form submission -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <select class="form-select form-control-lg" aria-label="Default select example" name="item">
                                        <option selected>Select Item</option>
                                        <option value="Cement">Cement</option>
                                        <option value="Bricks">Bricks</option>
                                        <option value="Sand">Sand</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="value" class="form-control" placeholder="Qty" name="quantity">
                                </div>
                            </div><br>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-group date" id="DatePicker">
                                        <input type="date" class="form-control" id="dateTo" placeholder="Needed Date" name="needed_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Special Note" name="special_note">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-lg-4 col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">Request Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/notification-panel.js"></script>
        <script>
        handleFormSubmit("request-form");
    </script>


</body>
</html>