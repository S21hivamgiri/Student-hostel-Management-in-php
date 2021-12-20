<?php 
    session_start();
   error_reporting(0);
   
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
if(!$result){
    header("location:../index.php");
}

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->grievance;
    $rn = htmlspecialchars($_GET['regno']);
    $gn = htmlspecialchars($_GET['giveno']);
    $rid = htmlspecialchars($_GET['rid']);
    $ridname = htmlspecialchars($_GET['ridname']);
    $updateResult = $document->updateOne(
        ['roll_no' => $rn,'grievance_id'=>$gn],
        ['$set' => [
            'status'=>"Acknowledged",
            'w_id'=>$rid,
            'w_name'=>$ridname,
            'ack_time'=> date("Y-m-d H:i:s")
        ]]
    );

header("location:view-grievance.php")
?>