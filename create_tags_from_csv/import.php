<?php
session_start();

if (!$_SESSION['logged'])
    header('Location: /index.php');
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Create Mautic Tags from CSV | Import CSV</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- Custom Style -->
        <link rel="stylesheet" href="assets/css/style.css"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Create Mautic Tag</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/controllers/logout.php">Sign out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Import Form -->
                <form action="controllers/import.php" method="post" enctype="multipart/form-data">
                    <div class="mt-4 mb-3">
                        <h4>Select a CSV file from your computer</h4>
                    </div>
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files</span>
                        <input type="file" name="file">
                    </span>
                    <div class="mt-3 mb-3">
                        <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                        <button type="reset" class="btn btn-danger cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    </div>
                </form>
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