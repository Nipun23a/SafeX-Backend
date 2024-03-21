<?php include ("css/css-links.php");
include("css/css-links.php");
require ("sidepanel.php");
require ("../Backend/database.php");
require("../Backend/Other-Script/random-string-generating.php");
require ("../Backend/Other-Script/phpqrcode/qrlib.php");
require("../Backend/Other-Script/tcpdf/tcpdf.php");

$user_role = $_SESSION["user_role"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeX|New Helmet</title>
    <style>
        body{
            margin-left: 220px;
        }
    </style>
</head>
<body>
    <h2>Helmet Registration Form</h2>
    <form action="" method="post"> 
        <div>
            <?php
            if($user_role == "admin"){
                echo'<label for="num_helmets">Number of Helmets:</label>';
                echo'<input type="number" id="num_helmets" name="num_helmets" min="1" required>';
                echo'<button type="submit" name="generate_qr">Register Helmets</button>';
            }elseif($user_role == "company"){
                echo'<label for="unique_code">Unique Code:</label>';
                echo'<input type="text" name="unique_code" required placeholder="Helmet Unique Code">';
                echo'<button type="submit" name="add_helmet">Register Helmets</button>';
            }

            ?>
        </div>
    </form>
    <?php

      if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate_qr"]) && $user_role == "admin"){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator('SafeX');
        $pdf->SetAuthor('SafeX');
        $pdf->SetTitle('QR Codes');
        $pdf->SetSubject('QR Codes');
        $pdf->SetKeywords('QR Codes');

        $pdf->AddPage();

    // Set font
        $pdf->SetFont('helvetica', '', 10);

        $path = 'qr_code_download';
        $num_helmets = isset($_POST['num_helmets']) ? $_POST['num_helmets'] : 1;
        for ($i = 0; $i < $num_helmets; $i++) {
            $code = generateRandomString(10);
            $qrcode = $code;
            QRcode::png($code, $path . time() . "_" . $i . ".png", 'H', 4);
            $sql = "INSERT INTO helmet (Helmet_Unique_Code) VALUES ('$code')";
            if ($database_connection->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $database_connection->error;
            }
            $pdf->Image($path . time() . "_" . $i . ".png", 10, 10 + ($i * 40), 50, 50);
            $pdf->Text(10, 70 + ($i * 80), $code);
        }
        $pdf_file = $path . 'qr_codes.pdf'; // Path relative to the web root
        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/' . $pdf_file, 'F');
        echo '<a href="' . $pdf_file . '" download>Download PDF</a>';
}

    ?>
</body>
</html>