<?php
 session_start();
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])]);
if(!$result){
    header("location:../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notice Section</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
<body>
    <div class="notice-title">
        <h1>Notice Board</h1>
    </div>
    <?php 
        require_once "../vendor/autoload.php";

        $client = (new MongoDB\Client);
        $collection = $client->hostel;
        $document = $collection->notice;
        $result = $document->find([],['sort'=>['upload_date'=>-1]]);
        foreach($result as $res)
        {
            $notice_header = $res['notice_header'];
            $notice_content = $res['notice_content'];
            $update = $res['upload_date'];
            $notice_id = $res['notice_id'];
            $notice_name = $res['name'];
          
            echo "
                <div class='nb'>
                    <div class='nb-header'>
                        <p>".$res['notice_header']."</p>
                    </div>
                    <div class='nb-date'>
                        <p>".$res['notice_id']."</p>
                        <p>".$res['upload_date']."</p>
                    </div>
                    <div class='nb-content'>
                        <p>".$res['notice_content']."</p>
                    </div>
                    <div class='nb-contact'>
                        <p>".$res['contact_person']."</p>
                    </div>
                    <div class='nb-upload'>
                        <p>Uploaded By: ".$res['name']." ".$res['role']." ".$res['wdn_id']."</p>
                    </div>
                </div>
            ";
            }
        ?>
</body>
</html>