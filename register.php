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
            <header>Sign Up</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
    
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
    
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="username" id="username" autocomplete="off" required>
                </div>
    
                <div class="field input">
                    <label for="username">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
    
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>

            </form>          
        </div>
    </div>
</body>
</html>