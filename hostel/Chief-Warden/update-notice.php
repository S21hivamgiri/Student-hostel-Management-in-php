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
$id= $af["wdn_id"];    
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
                if(isset($_POST['update-notice']))
                {

                    $nh = $_POST['notice-header'];
                    $nc = $_POST['notice-content'];
                  
   
                   
                    $client = (new MongoDB\Client);
                    $collection = $client->hostel;
                    $document = $collection->notice;
                    $count=$document-> count();

                    if($count == 0)
                    {
                        $count++;
                       
                    }
                    else{
                        $count = $count + 1;
                      
                    }
                    $invID = str_pad($count, 7, '0', STR_PAD_LEFT);
                    $noticeid="NOTICE".$invID;
                    $upload_date = date("l d-m-Y");
                    $insertStmt = $document->insertOne([
                        'notice_header' => $nh, 
                        'notice_content' => $nc, 
                        'wdn_id' => $id, 
                        'role'=>$af['role'],
                        'name' => $name, 
                        'notice_id' => $noticeid, 
                        'upload_date' => $upload_date, 
                        'contact_person'=>"Contact: ".$_POST['contact']."  ".$_POST['contact_num']
                        
                        
                    ]);
                    echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                    The notice has been successfully uploaded with reference id: <b>". $noticeid."</b>
                </div>";
                   
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Update Notice</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="notice-header">Enter Notice Title</label>
                <input type="text" class="form-control" name="notice-header" placeholder="Enter Notice Title" required>
            </div>
            <div class="form-group">
                <label for="notice-content">Enter Notice Content</label>
                <textarea name="notice-content" class="notice-body" cols="30" rows="10" placeholder="Enter Notice Body"></textarea>
            </div>
            <div class="form-group">
                <label for="notice-header">Enter Contact person if Any with name</label>
                <input type="text" class="form-control" name="contact" placeholder="Enter any contact Person Name:(if any)">
            </div>
             <div class="form-group">
                <label for="notice-header">Enter Contact of the person</label>
                <input type="text" class="form-control" name="contact_num" placeholder="Enter any contact Number:(if any)">
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="update-notice" value="Submit">
        </form>
    </div>
</body>
<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</html>