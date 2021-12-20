<?php 
  session_start();
  require_once "../vendor/autoload.php";
  date_default_timezone_set("Asia/Kolkata");
  error_reporting(0);
  
  $client = (new MongoDB\Client);
  $collection = $client->hostel;
  $document = $collection->users;
  
  $result = $document->findOne(['username' => $_SESSION['username'], 'password' =>( $_SESSION['password'])]);
  if(!$result){
      header("location:../index.php");
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <title></title>
</head>
<body>
    <div class="cp-div pwd-wide">
        <form action="" method="post">
            <?php 
                if(isset($_POST['updatePwd'])){
                    if($_POST['newPassword'] !== $_POST['confirmPassword']){
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Passwords don't match!
                            </div>";
                    } else if(md5($_POST['prePassword']) !== ($_SESSION['password'])){
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Present password is wrong if forgot logout and Forget Password
                            </div>";
                    } 
                    else if($_POST['newPassword'] === $_POST['confirmPassword']){
                        $new_Password = md5($_POST['newPassword']);
                        $updateQuery = $document->updateOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])], 
                        ['$set' => ['password' => $new_Password]]);
                        session_destroy();
                        echo '<script>
                                window.top.location.href = "../index.php";
                                alert("Password Updated Successfully!");
                              </script>'; 
                    }
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Update Password</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="registrationNo">Enter Present Password</label>
                <input type="password" class="form-control" name="prePassword" placeholder="Enter Present Password" required>
            </div>
            <div class="form-group">
                <label for="newPassword">Enter New Password</label>
                <input type="password" class="form-control" name="newPassword" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <div class="form-group center-align">
                <input type="submit" class="btn btn-primary img-ctn-btn" name="updatePwd" value="Submit">
            </div>
        </form>
    </div>
</body>
<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</html>