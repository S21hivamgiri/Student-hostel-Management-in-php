<?php 
    session_start();

   
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);


    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->grievance;
    $rn = htmlspecialchars($_GET['regno']);
    $gn = htmlspecialchars($_GET['giveno']);
  
    $updateResult = $document->updateOne(
        ['roll_no' => $rn,'grievance_id'=>$gn],
        ['$set' => [
            'status'=>"Verified",
          
        ]]
    );

header("location:update-grievance.php")
?>