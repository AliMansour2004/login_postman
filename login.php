
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class = "login_container">
        <form action="pages/login_action.php" method="post" class="form_container">

            <div class="form_group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="form_group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="button_container">
                <button type="submit" class="button">Login</button>
                <button type="reset" class="button">Reset</button>
            </div>

            <div class="link_container">
                <a href="pages/forgot_password.php">Forgot Password?</a>
            </div>

            <div class ="link_container">
                <a href="pages/signup.php">Create Account</a>
            </div>

        </form>
    
    </div>

</body>

</html>
