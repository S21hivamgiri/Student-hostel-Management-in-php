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
             $document = $collection->academics;
                if(isset($_POST['updatePwd']))
                {
                        $new_Password = $_POST['newPassword'];
                        $insertQuery = $document->insertOne(['hostel' => $_POST['dept-name'],
                        'hostel-for' => $_POST['gender'] ,
                        'role'=>"hostel",
                        'floor'=>$_POST['number'],
                        'in-time'=>$_POST['time']]);

                           echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The hostel ".$_POST['dept-name']. " sucessfully updated for  ".$_POST['gender'].".
                            </div>";
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Insert New Hostel</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="dept-name">Enter Hostel Name</label>
                <input type="text" class="form-control" name="dept-name" placeholder="Enter Hostel Name" required>
            </div>
            <div class="form-group">
                <label for="dept-name">This Hostel is for:</label><br>
                <input type="radio" name="gender" value="male" class="login-fields-r spec-2" required><span class="radio">Male</span><br>
                <input type="radio" name="gender" value="female" class="login-fields-r spec-2" required><span class="radio">Female</span> <br>
                
            </div>
        
            <div class="form-group">
                <label for="time">Enter In-time of the hostel</label>
                <input type="time" class="form-control" name="time" placeholder="Enter in-time of hostel" required>
            </div>
             <div class="form-group">
                <label for="time">Enter No. of floor(Ground as '0')</label>
                <input type="number" class="form-control" name="number" min="0" max="4" placeholder="Enter number of floor" required>
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="updatePwd" value="Submit">
        </form>
    </div>
</body>
<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</html>