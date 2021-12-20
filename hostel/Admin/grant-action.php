<?php
session_start();
//error_reporting(0);
require_once "../vendor/autoload.php";
$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->leave;
$l_id = htmlspecialchars($_GET['l_id']);
    
if(isset($_POST['leaverefuse']))
{
    
 

    
    
    $comment= $_POST['comment'].": Warden refuses the leave.";
    $updateQuery = $document->updateOne(['l_id' => $l_id], 
    ['$set' => ['comment' => $comment,'grant'=>1,
    'journey'=>-1]]);
    header("location:leave-grant.php");
}
if(isset($_POST['leavegrant']))
{
    
    $comment= $_POST['comment'].": Warden accepted the leave.";

    
    $updateQuery = $document->updateOne(['l_id' => $l_id], 
    ['$set' => ['comment' => $comment,
    'journey'=>-1,'grant'=>1,
    'w_verified'=>1]]);
    header("location:leave-grant.php");
}
?>