<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

            <?php

            include("php/config.php");
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];

                //verifying the unique email

                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                if(mysqli_num_rows($verify_query) !=0 ){
                    echo "<div class='message'
                    <p>This email is used, Try another One Please!</p>
                    </div> <br>";
                    echo "<a href='Javascript:self.history.back()'><button class='btn'>Go Back</button>";
                }
                else{

                    mysqli_query($con, "INSERT INTO users(Username,Email,Age,Password) VALUES('$username', '$email', '$age', '$password')") or die("Error Occured");

                    echo "<div class='message'
                    <p>Registration Successfully!</p>
                    </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button>";
                }

            } else{

            ?>

            <header>Sign Up</header>
            <form action="" method="post">

            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register">
            </div>
            <div class="links">
                Already a member? <a href="index.php">Sign In</a>
            </div>

            </form>          
        </div>
        <?php } ?>
    </div>
</body>
</html>