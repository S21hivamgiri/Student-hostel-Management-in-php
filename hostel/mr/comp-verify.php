<?php 
    session_start();

   
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);


    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->complaint;
    $rn = htmlspecialchars($_GET['regno']);
    $gn = htmlspecialchars($_GET['giveno']);
  
    $updateResult = $document->updateOne(
        ['roll_no' => $rn,'complaint_id'=>$gn],
        ['$set' => [
            'status'=>"Verified",
          
        ]]
    );

header("location:update-complaint.php")
?>