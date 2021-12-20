<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->register;        
    $rid = htmlspecialchars($_GET["uid"]);
     $role = htmlspecialchars($_GET["role"]);
    
    $it = $_POST['out-time'];
   

    if(isset($_POST['update-entry']))
    {
       
        $updateQuery = $document->updateOne(['id' => $rid,'role'=>$role], 
        ['$set' => ['verified'=>'1']]);
    }
    header("location:out-entry.php");
?>