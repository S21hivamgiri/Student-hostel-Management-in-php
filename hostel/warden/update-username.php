<?php 
    session_start();
  
 
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    
    $af = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$af){
        header("location:../index.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="../assets/js/scripts.js"></script>
  </head>
<body>
    <div class="cp-div pwd-wide">
        <form action="" method="post">
            <?php 
                if(isset($_POST['updateUsr'])){
                    if($_POST['newUsername'] !== $_POST['confirmUsername']){
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Usernames don't match!
                            </div>";
                    }
                    else if($_POST['newUsername'] === $_POST['confirmUsername']){
                        $new_username = $_POST['newUsername'];
           
                        $findQuery = $document->findOne( ['username' => $_POST['newUsername']]);
                        if($findquery)
                        {
                        
                        $updateQuery = $document->updateOne( ['username' => $_SESSION['username'], 'password' => $_SESSION['password']],
                        ['$set' => ['username' => $new_username]]);
                        session_destroy();
                        echo '<script>
                                window.top.location.href = "../index.php";
                                alert("Username Updated Successfully!");
                              </script>'; 
                            
                            }
                            else echo"<div class='alert alert-danger index-alert-upd' role='alert'>
                            Username already exist!
                            </div>";
                     }
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Update Username</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="registrationNo">Present User Name</label><br><b>
                <?php echo $_SESSION['username']; ?> </b>
                </div>
            <div class="form-group">
                <label for="newUsername">Enter New Username</label>
                <input type="text" class="form-control" name="newUsername" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="confirmUsername">Confirm Username</label>
                <input type="text" class="form-control" name="confirmUsername" placeholder="Confirm Username" required>
            </div>
            <div class="form-group center-align">
                <input type="submit" class="btn btn-primary img-ctn-btn" name="updateUsr" value="Submit">
            </div>
        </form>
    </div>
<script src="../assets/js/scripts.js"></script>
<?php include('../dashboardfooter.php'); ?>