<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");

    echo "<div class='alert alert-success index-alert-upd' role='alert'>
    You have successfully registered Security for" .$_SESSION['hostel']."in NITPy Online Hostel Management.<br>
    The username is: <span style='font-weight:bold'>".$_SESSION['username']."</span>  =>  is Case Sensitive
    The sec_id is:".$_SESSION['username']."
    </div>";

    
    ?>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <script src="../assets/js/google/recaptcha/api.js" async defer></script> -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <script src="./assets/js/scripts.js"></script>
</head>
<body>

        <div class="section_title_h1">
            <h1><a href="./index.php">Login Account</a></h1>
        </div>
        </body>
        </html>