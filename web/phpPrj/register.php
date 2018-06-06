<?php 
session_start();

if (isset($_SESSION['users'])) {
    /* if you're already logged in then you don't need to be here */
    // header("Location: ./index.php");
    // exit();
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/login.css" />
</head>

<body>
    <?php require 'header.php' ?>
    <main>
        <div class='main-banner'></div>
        <div id="register">
            <h1>Register</h1>
            <?php
                // message is defined in the header
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <div class="form-wrapper flex-wrapper space-between">
                <form method="POST" action="controller.php">
                    <input type="hidden" name="action" value="register">
                    <div class="flex-wrapper space-between">
                        <label for="fName">First name:</label>
                        <input type="text" id="fName" name="fName">
                    </div>
                    <div class="flex-wrapper space-between">
                        <label for="lName">Last name:</label>
                        <input type="text" id="lName" name="lName">
                    </div>
                    <div class="flex-wrapper space-between">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="flex-wrapper space-between">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="flex-wrapper space-between">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword">
                    </div>
                    <input type="submit" class="button" value="Register">
                </form>
                <div class="message warning">
                    <p>PLEASE create a unique password! This site is not on an HTTPS connection and network traffic (your password) IS NOT private.</p>
                </div>
            </div>
        </div>
    </main>
    <?php require 'footer.php' ?>
</body>

</html>