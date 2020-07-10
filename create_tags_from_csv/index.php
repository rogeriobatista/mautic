<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Create Mautic Tags from CSV | Login</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Custom Style -->
        <link rel="stylesheet" href="assets/css/style.css"
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <!-- Error Message -->
            <?php
                if (isset($_SESSION['error_message'])) {
                    $message = $_SESSION['error_message'];

                    echo "<div class='alert alert-danger alert-dismissible fade show'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Error!</strong> $message
                    </div>";

                    session_destroy();
                }
            ?>
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first">
                <img src="https://via.placeholder.com/270" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form action="controllers/login.php" method="post">
                    <input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                    <input type="submit" class="fadeIn fourth" value="Log In">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
                </div>

            </div>
        </div>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>