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
   
$name= $af["name"]; 
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
                if(isset($_POST['update-emergency']))
                {

                    $_POST['emergency-name'];
                    $_POST['emergency-des'];
                    $_POST['emergency-email'];
                    $_POST['emergency-num'];
                  
   
                   
                    $client = (new MongoDB\Client);
                    $collection = $client->hostel;
                    $document = $collection->emergency;
                    
    $i = $document->count(["role"=>"general"]);
                    $val=$i+1;
                    $upload_date = date("l d-m-Y");
                    $insertStmt = $document->insertOne([
                       
                        'id'=>"G".$val,
                        'name'=>$_POST['emergency-name'],
                        'desg'=>$_POST['emergency-des'],
                        'email'=>$_POST['emergency-email'],
                        'contact'=>$_POST['emergency-num'],
                        'remark'=>$_POST['emergency-remark'],
                        'upload_date' => $upload_date,
                        'role'=>"general"    
                        
                        
                    ]);
                    echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                    The emergency contact ".$_POST['emergency-name']." , ".$_POST['emergency-des']. " has been successfully uploaded</b>
                </div>";
                   
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Insert Contact for General Use</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="emergency-name">Enter Contact Name</label>
                <input type="text" class="form-control" name="emergency-name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="emergency-name">Enter Designation, Occupation</label>
                <input type="text" class="form-control" name="emergency-des" placeholder="Enter Designation" required>
            </div>
            <div class="form-group">
                <label for="emergency-name">Enter Contact Number</label>
                <input type="number" class="form-control" name="emergency-num" placeholder="Enter Contact Number" required>
            </div>
             <div class="form-group">
                <label for="emergency-header">Enter Contact of the person</label>
                <input type="email" class="form-control" name="emergency-email" placeholder="Enter Email Id.:(if any)">
            </div>
            <div class="form-group">
                <label for="emergency-header">Remark/ Other Infos</label>
                <input type="text" class="form-control" name="emergency-remark" placeholder="Any other information(optional)">
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="update-emergency" value="Submit">
        </form>
    </div>
</body>
<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</html>