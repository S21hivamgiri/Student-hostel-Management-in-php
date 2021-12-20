<?php 
    session_start();
    error_reporting(0);
    require_once "../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->complaint;


    $rn = htmlspecialchars($_GET['regno']);
    $gn = htmlspecialchars($_GET['giveno']);
    $rid = htmlspecialchars($_GET['rid']);
    $ridname = htmlspecialchars($_GET['ridname']);
    
    $updateResult = $document->updateOne(
        ['roll_no' => $rn,'complaint_id'=>$gn],
        ['$set' => [
            'status'=>"Acknowledged",
            'w_id'=>$rid,
            'w_name'=>$ridname,
            'ack_time'=> date("Y-m-d H:i:s")
        ]]
    );

  
header("location:view-complaint.php")
?>