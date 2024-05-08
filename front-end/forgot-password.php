
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<body>

    <div class="container">
        <div class="box form-box">
            <header>Forgot Password</header>
            <form action="send-password-reset.php" method="post">

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
    
    
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Send" required>
                </div>
            </form>          
        </div>
    </div>

</body>
</html>