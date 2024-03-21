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
    <title>SafeX|Inquire</title>
    <style>


    #not {
        text-align: center;
    }
    </style>
</head>
<body>
<div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Company Name</th>
                    <th class="resizable">Employee Name</th>
                    <th class="resizable">Date of Inquiring</th>
                    <th class="resizable">Description</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row;
                $row_number=1;
                $inquire_query="SELECT ir.*, c.Company_Name,e.Name FROM  issue_reporting  ir LEFT JOIN company c ON ir.Report_Company_ID = c.Company_ID
                LEFT JOIN employee e ON ir.Report_Employee_ID = e.Employee_ID; ";
                $inquire_result=mysqli_query($database_connection,$inquire_query);
                if($inquire_result->num_rows>0){
                    while($row=$inquire_result->fetch_assoc()){
                        echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Company_Name'] . '</td>
                        <td>' . $row['Name'] . '</td>
                        <td>' . $row['Report_Date'] . '</td>
                        <td>' . $row['Description'] . '</td>
                        <td>
                            <a href="inquire.php?delete=' . $row['Report_ID'] . '"class="btn btn-danger">Delete</a>
                        </td>
                        </tr>';
                        $row_number++;
                    }
                }else{
                    echo '<tr><td colspan="6" class="center-container"><h5 id="not">No Data Found</h5></td></tr>';


                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>