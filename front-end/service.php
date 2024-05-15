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
    <title>DailyNewsChart - About</title>
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
body, html {
  margin: 0;
  padding: 0;
  width: 100%;
  min-height: 100%;
  overflow-x: hidden;
  font-family: 'Montserrat', sans-serif;
  background: linear-gradient(to bottom, #0d0d2b, #000000);
  color: white;
}

/* Custom scrollbar styling */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #0C0C27;
}

::-webkit-scrollbar-thumb {
  background: #ff4081;
  border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover {
  background: #e00070;
}

.navbar {
  position: fixed;
  top: 20px;
  left: 20px;
  right: 20px;
  padding: 10px 20px;
  margin: 0 60px;
  display: flex;
  justify-content: space-between;
  font-size: 16px;
  align-items: center;
  transition: background 0.3s, color 0.1s, top 0.3s, left 0.3s, right 0.3s, padding 0.3s, margin 0.3s, box-shadow 0.3s;
  z-index: 1000;
}

.navbar.sticky {
  background: #0C0C27;
  color: #ff4081;
  top: 0;
  left: 0;
  right: 0;
  margin: 0;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.navbar a {
  color: inherit;
  text-decoration: none;
  font-weight: 600;
  margin: 0 15px;
  transition: color 0.3s;
}

.nav-links {
  display: flex;
}

.hamburger {
  display: none;
  flex-direction: column;
  cursor: pointer;
}

.hamburger div {
  width: 25px;
  height: 3px;
  background-color: white;
  margin: 4px;
  transition: all 0.3s ease;
}

.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  top: 0;
  right: 0;
  background-color: #0C0C27;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  z-index: 1000;
}

.sidebar a {
  padding: 10px 15px;
  text-decoration: none;
  font-size: 22px;
  color: #ff4081;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #e00070;
}

.sidebar .closebtn {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 36px;
}

.container {
  height: 100vh;
  text-align: center;
  padding: 50px 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  z-index: 2;
}

.container:nth-child(odd) {
  background: rgba(0, 0, 0, 0.253);
}

h1 {
  font-size: 3em;
  margin-bottom: 0.5em;
}

p {
  font-size: 1.5em;
  margin-bottom: 1em;
}

.cta-button {
  background: linear-gradient(135deg, #ff4081, #e00070);
  padding: 1em 2em;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  box-shadow: 0 0 15px rgba(255, 64, 129, 0.5);
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

.cta-button:hover {
  background: linear-gradient(135deg, #e00070, #ff4081);
  box-shadow: 0 0 25px rgba(255, 64, 129, 0.7);
}

.particles {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 1;
}

.particle {
  position: absolute;
  width: 2px;
  height: 2px;
  background: white;
  border-radius: 50%;
  opacity: 0;
  box-shadow: 0 0 5px 1px white;
  animation: float 10s infinite;
}

@keyframes float {
  0% {
    transform: translateY(0) translateX(0);
    opacity: 0.7;
  }
  50% {
    opacity: 1;
  }
  100% {
    transform: translateY(-100vh) translateX(calc(-50vw + 100%));
    opacity: 0;
  }
}

.star-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
  z-index: 0;
}

.star {
  position: absolute;
  width: 1px;
  height: 1px;
  background: white;
  opacity: 0.8;
}

.features {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.feature-item {
  max-width: 300px;
  text-align: center;
  padding: 20px;
  margin: 20px 0;
}

.logos {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  padding: 20px;
}

.logos img {
  max-width: 100px;
  margin: 20px;
}

.slider {
  width: 80%;
  max-width: 800px;
  overflow: hidden;
  position: relative;
  margin: 20px auto;
}

.slides {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.slide {
  min-width: 100%;
  box-sizing: border-box;
}

.slider img {
  width: 100%;
  border-radius: 10px;
}

.slider-buttons {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
}

.slider-button {
  background: rgba(0, 0, 0, 0.5);
  border: none;
  color: white;
  padding: 10px;
  cursor: pointer;
}

.footer {
  background: #0C0C27;
  color: #ff4081;
  text-align: center;
  padding: 20px;
  position: relative;
}

.footer a {
  color: #ff4081;
  text-decoration: none;
  margin: 0 10px;
  font-weight: 600;
}

.footer a:hover {
  color: #e00070;
}

@media (min-width: 768px) {
  .features {
    flex-direction: row;
    justify-content: space-around;
  }
}

@media (max-width: 768px) {
  .navbar {
    top: 10px;
    left: 10px;
    right: 10px;
    margin: 0;
  }

  .navbar.sticky {
    padding: 10px;
  }

  .nav-links {
    display: none;
  }

  .hamburger {
    display: flex;
  }

  h1 {
    font-size: 2em;
  }

  p {
    font-size: 1.2em;
  }

  .cta-button {
    padding: 0.8em 1.5em;
  }
}

.boxtitle {
    background-color: #f8f9fa;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 500px; /* Προσαρμόζει το μέγιστο πλάτος του κουτιού */
    max-height: 400px;
    margin: 200px auto; /* Κεντράρει το κουτί οριζόντια */
}

.boxtitle h2 {
    font-weight: bold;
    color: #fff;
}

.boxtitle hr {
    border: none;
    background-color: #fff;
}

.boxtitle ul p {
    margin-bottom: 10px;
    color: #fff;
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
.box {
    max-width: 300px; /* Προσαρμόζει το μέγιστο πλάτος του κουτιού */
    margin: 20px auto; /* Κεντράρει το κουτί οριζόντια */
    padding: 15px; /* Προσθέτει εσωτερικό padding στο κουτί */
    border-radius: 10px; /* Προσθέτει κυρτότητα στις γωνίες του κουτιού */
    background-color: #f8f9fa; /* Χρώμα φόντου του κουτιού */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Προσθέτει σκιά στο κουτί */
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
<div class="navbar" id="navbar">
  <div class="logo">
    <a href="index.php" style="font-size: 20px;">DailyNewsChart</a>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="service.php">Services</a>
    <a href="contact.php">Contact</a>
  </div>
  <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<div id="sidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" id="closebtn">&times;</a>
  <a href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="service.php">Services</a>
  <a href="contact.php">Contact</a>
</div>

      <div class="container boxtitle">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
            <h2 class="text-center mb-4">Service</h2>
                <hr class="mb-4 mt-0 mx-auto" style="width: 220px; background-color: #7c4dff; height: 2px">
                <ul class="list-unstyled text-center mb-4">
                    <p class="fs-5">This application is developed for academic assessment.</p>
                    <p class="fs-5">Email: 100675745@unimail.derby.ac.uk</p>
                </div>
            </div>
        </div>
    </div>


    <div class="footer">
  <p class="fs-5">&copy; 2024 DailyNewsChart. All rights reserved.</p>
  <p class="fs-5">
    <a href="#">Privacy Policy</a> | 
    <a href="#">Terms of Service</a> | 
    <a href="contact.php">Contact Us</a>
  </p>
</div>  
        

<script>
document.addEventListener('DOMContentLoaded', function() {
    var hamburger = document.getElementById('hamburger');
    var sidebar = document.getElementById('sidebar');
    var closebtn = document.getElementById('closebtn');

    hamburger.addEventListener('click', function() {
        sidebar.style.width = '250px';  // Ανοίγει το sidebar
    });

    closebtn.addEventListener('click', function() {
        sidebar.style.width = '0';  // Κλείνει το sidebar
    });
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>