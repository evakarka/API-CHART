<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyNews</title>
    <link rel="icon" href="/img/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
<style>
  .boxtitle{
    border: 1px solid #fff;
    border-radius: 10px;
    padding: 200px 0;
  }
  
.container{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 0;
}
.box{
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    padding: 25px 25px;
    border-radius: 20px;
    box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
}
.form-box{
    width: 450px;
    margin: 0px 10px;
}
.form-box header{
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 10px;
}
.form-box form .field{
    display: flex;
    margin-bottom: 10px;
    flex-direction: column;
}
.form-box form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}
.btn{
  height: 35px;
    background: rgba(76, 68, 128, 0.808);
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: 10px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
    text-align: center; /* Ευθυγράμμιση του κειμένου στο κέντρο */
    line-height: 35px; /* Κεντράρισμα του κειμένου κάθετα μέσα στο κουμπί */
    
}
.btn:hover{
    opacity: 0.82;
}
.sumbit{
    width: 100%;
}
.link{
    margin-bottom: 15px;
}
.btn-outline-primary {
    border: 1px solid rgb(119, 44, 229); /* Μωβ περίγραμμα */
    box-shadow: 0 0 10px 0 rgba(186, 85, 211, 0.5); /* Μωβ σκιά */
    /* rgb(186, 253, 211) */
}
.btn-sm {
    box-shadow: 0 0 6px 0 rgba(186, 85, 211, 0.5); /* Μωβ σκιά */
}

</style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="index.php">DailyNewsChart</a>
          <!-- Toggle Btn -->
          <button class="navbar-toggler shadow-none border-0" 
          type="button" 
          data-bs-toggle="offcanvas" 
          data-bs-target="#offcanvasNavbar" 
          aria-controls="offcanvasNavbar" 
          aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- SideBar -->
          <div class="sidebar offcanvas offcanvas-start" 
            tabindex="-1" 
            id="offcanvasNavbar" 
            aria-labelledby="offcanvasNavbarLabel">

            <!-- SideBar Header -->
            <div class="offcanvas-header text-white border-bottom">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #002144; font-weight: bold; font-size: 1.2em;">DAILYNEWSCHART</h5>
              <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- SideBar Body -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
              <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#" style="color: #002144; font-weight: bold;">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#about" style="color: #002144; font-weight: bold;">About</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#service" style="color: #002144; font-weight: bold;">Service</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#contact" style="color: #002144; font-weight: bold;">Contact</a>
                </li>
              </ul>
              <!-- Login / Sign up -->
              <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                
                <?php if (isset($user)): ?>
                  <p><a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a></p>
                  
                <?php else: ?>
                  
                <p><a href="loginform.html" class="text-white text-decoration-none px-3 py-1 rounded-4"
                style="background-color: #fff">Login</a> <a href="signup.html" 
                class="text-white text-decoration-none px-3 py-1 rounded-4"
                style="background-color: #f94ca4">Sign Up</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <div class="container boxtitle">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <h2 class="text-center mb-4">Scientific journals on Daily Minimum Temperatures data analysis</h2>
                <div class="mb-3">
                    <p>This application calls upon global data published in <a href="https://catalog.data.gov/dataset/?res_format=CSV">DATA.GOV</a>.</p>
                    <p>In order to use it, you have to login to the platform.</p>
                </div>
                <?php if (isset($user)): ?>
                    <p><a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a></p>
                <?php else: ?>
                    <p><a class="btn btn-outline-primary btn-sm" href="login.php">Login</a> or <a class="btn btn-outline-primary btn-sm" href="signup.html">Register</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>



    <!-- website footer -->
    <footer class="custom-footer text-center text-lg-start text-white" style="background-color: #002144">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
            <!-- Left -->
            <div class="me-5">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="custom-section">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">DailyNewsChart</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Aid</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white">Privacy Setting</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Connection</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Cookies policy</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Privacy Policy</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white">Terms of Service</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Company details</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Comany</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> Athens, 10679, GR</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone mr-3"></i> + 30 690 000 00</p>
                        <p><i class="fas fa-print mr-3"></i> + 30 210 000 00</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">DailyNewsChart.com</a>
        </div>
        <!-- Copyright -->
    </footer>

        
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>