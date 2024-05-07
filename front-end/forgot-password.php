<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"> <button class="btn">Log Out</button></a>
        </div>
    </div>


    <div class="container">
        <div class="box form-box">
            <header>Forgot Password</header>
            <form action="send-password-reset.php" method="post">

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
    
    
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>


            </form>          
        </div>
    </div>

</body>
</html>