<?php 

  
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

 $cook="";
 setcookie("doom_time", $cook, time()+365*24*60*60); 
 setcookie("feed","0" , time()+30*24*60*60);                            
$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;
$updateQuery = $document->updateOne(['role' => "Warden"], 
['$set' => ['feed' => "0","feed_time"=>"0"]]);
$updateQuery = $document->updateOne(["role"=>"Student"], 
['$set' => ['feed' => "0","feed_time"=>"0"]]);
   

?>

  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	<div class='alert alert-danger' role='alert'>
The Feedback system is de-activated
</div>