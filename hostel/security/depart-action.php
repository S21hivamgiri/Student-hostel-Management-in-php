<?php
session_start();
//error_reporting(0);
require_once "../vendor/autoload.php";
$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->leave;
$l_id = htmlspecialchars($_GET['l_id']);
    

if(isset($_POST['depart']))
{
    
    $comment= $_POST['comment'].":::::::::::::::::::::::::::::On the journey::::::::::::::::::::";

    
    $updateQuery = $document->updateOne(['l_id' => $l_id], 
    ['$set' => ['comment' => $comment,
    'journey'=>1,
    'out_time'=>date("h:i:s A"),
    'sec_verified'=>1]]);
    
    header("location:departure.php");
}
?>