<?php
session_start();

if (!$_SESSION['logged'])
    header('Location: /tag-import/index.php');
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Create Mautic Tags from CSV | Import CSV</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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
                        <a class="nav-link" href="/tag-import/controllers/logout.php">Sign out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Import Form -->
                <form action="controllers/import.php" method="post" enctype="multipart/form-data" id="form-upload">
                    <h4 class="mt-4 mb-3">Upload CSV File</h4>
                    <div class="mt-4 mb-3">
                        <span>Select a CSV file</span>
                        <span class="btn btn-success">
                            <input type="file" name="file" required>
                        </span>
                    </div>
                    <div class="mt-4 mb-3" style="width: 330px; margin-left: auto; margin-right: auto;">
                        <span>Select the CSV Source</span>
                        <select name="source" class="form-control" required>
                            <option value="rd-station">RD Station</option>
                            <option value="klick-send">Klick Send</option>
                        </select>
                    </div>
                    <div class="mt-4 mb-3" style="width: 330px; margin-left: auto; margin-right: auto;">
                        <span>Separator</span>
                        <input name="separator" class="form-control" required>
                    </div>
                    <div class="mt-3 mb-3">
                        <button type="submit" class="btn btn-primary" id="btn-upload">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                        </button>
                        <button type="reset" class="btn btn-danger" id="btn-reset-upload">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    </div>
                    <div class="mt-3 mb-3 hide" id="upload-status">
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

        <!-- Import -->
        <script src="assets/js/import.js"></script>
    </body>
</html>