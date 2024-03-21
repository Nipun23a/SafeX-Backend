<?php include "css/css-links.php";
    include ("../Backend/login.php");
?>
<!doctype html>
<html lang="en">
    
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafeX|Login</title>

    <!--css links-->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="img/helmet.png" type="image/x-icon">
    
    
  </head>
  
    <body>

        <!--Hero section-->
        <div id="hero" class="col-12 min-vh-100 text-center align-items-center d-flex">
            <div class="col-12">

                <!--heading section-->
                <div class="container p-4 mb-2">
                    <figure class="text-center mt-5">
                        <blockquote class="blockquote">
                            <h1 class="herotext">Welcome to SafeX</h1>
                        </blockquote>
                        
                        <figcaption class="blockquote">
                            <p id="para" class="text-dark fs-6">Empower Safety, Enhance Connectivity, Elevate Lifestyle.</p>
                        </figcaption>
                    </figure>
                    
                </div>

                <!--helmet icon section-->
                <div id="helmet">
                    <img src="img/helmet.png" class="img-fluid rounded-4 mx-auto d-block" width="100px" height="100px">
                </div>

                <!--login form-->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <form action="login.php" method="post">    
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include "../Backend/Error-Handling/login-error.php"?>

                <footer>
                    <div class="footerBottom mt-3">
                        <p>&copy; All Rights Reserved </p>
                    </div>
                </footer>

            </div>
        </div>

        <!--bootstrap javascript links-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>
