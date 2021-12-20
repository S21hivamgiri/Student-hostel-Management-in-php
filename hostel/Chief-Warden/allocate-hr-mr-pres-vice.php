<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <script src="../assets/js/google/recaptcha/api.js" async defer></script> -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $meal = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$meal){
        header("location:'../index.php");
    }
    $host=$meal['hostelno'];
    
   
   
   ?>
      <div class="centerstage row">
        <div class="container infostage">
            <div class="container initiate-file">
                <div class="feedback">
                   <form action="" method="POST">
                            
                            <div class="section_title spread">
                                  <h1>Choose the Credentials</h1>
                            </div>
                            <br><br>
                    <div class="form-group">
                    <label>Representative Specialization</label><br>
                    <input type="radio" name="food" value="mr" class="login-fields-r spec-2" required><span class="radio">Mess Representative</span> <br>
                    <input type="radio" name="food" value="hr" class="login-fields-r spec-2" required><span class="radio">Hostel Representative</span> <br>
                    <input type="radio" name="food" value="student-council" class="login-fields-r spec-2" required><span class="radio">Student Council member</span> <br>
                    </div>
                        <div class="form-group">
                       
                        <input type="submit" name="course" value="Submit Course Info" class="btn btn-primary img-ctn-btn">
                       </div>
                       <?php
                       if(isset($_POST['course'])){
                      
                       $_SESSION['role']=$_POST['food'];
                       
                       header("location:choose-academics.php");
                       }
                       ?>
                </form>
                </div></div></div></div>