<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");

    echo $_SESSION['pic'].$_SESSION['proof'];

    echo "<div class='alert alert-success index-alert-upd' role='alert'>
    You have successfully registered for NITPy Online Hostel Management
    
    <br>You Would be need to verify Your Email, Open the link and activate your account ";
   
    echo "</div>";
    ?>
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



        <div class="section_title_h1">
            <h1><a href="./student/view-profile.php?regno=<?php echo $_SESSION['roll_no']?>">See  Profile</a></h1>
        </div>
        <div class="section_title_h1">
            <h1><a href="./index.php">Login Account</a></h1>
        </div>