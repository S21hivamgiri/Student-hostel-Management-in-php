<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->register;        
    $rid = htmlspecialchars($_GET["uid"]);
     $role = htmlspecialchars($_GET["role"]);
    
    $it = $_POST['in-time'];
   

    if(isset($_POST['update-entry']))
    {
       
        $updateQuery = $document->updateOne(['id' => $rid,'role'=>$role], 
        ['$set' => ['in_time' => $it]]);
    }
    if($role==="Visitor Room")
    header("location:vis-entry.php");
    header("location:just-history.php?room_select=".$role);
?>