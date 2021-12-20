<?php 
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <title>Hostel Management System - NIT Puducherry</title>
  </head>
  <body class="overflow-hidden">
    <nav class="navbar navbar-light">
      <a class="navbar-brand" target="_blank" href="http://www.nitpy.ac.in">
        <img src="../assets/img/logo.png" width="55" height="55" class="d-inline-block align-top" alt="Institute Logo">
        <div class="dashboard navbar_contents">
          <h1>Online  Hostel  Management  System</h1>
          <p class="trans">National Institute of Technology Puducherry</p> 
        </div>
      </a>
      <div class="account">
        <div class="clickable">
          <i class="fas fa-user-circle"></i><span class="acc-name"><?php echo $_SESSION['name']; ?></span>
        </div>
        
      </div>
    </nav>