<?php
session_start();
error_reporting(0);
require_once "../vendor/autoload.php";
$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->leave;
$l_id = htmlspecialchars($_GET['l_id']);
    

if(isset($_POST['arrive']))
{
    
    $comment= $_POST['comment']."::::::::::::::::::::::::Returned from the journey:::::::::::::::::::::::::";

    
    $updateQuery = $document->updateOne(['l_id' => $l_id], 
    ['$set' => ['comment' => $comment,
    'journey'=>2,
    'in_time'=>date("h:i:s A"),
    'end'=>date("Y-m-d")
    ]]);
    header("location:arrival.php");
}
?>