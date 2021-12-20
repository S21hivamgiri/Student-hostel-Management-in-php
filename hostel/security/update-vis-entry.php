<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->register;        
    $rid = htmlspecialchars($_GET["uid"]);
     $role = htmlspecialchars($_GET["role"]);
    
    $it = $_POST['in-time'];
    $id = $_POST['in-date'];

    if(isset($_POST['update-entry']))
    {
      
            $updateQuery = $document->updateOne(['id' => $rid,'role'=>$role], 
        ['$set' => ['out_time' => $it, 'out_date' => $id]]);
          }
    header("location:inside-entry.php?room_select=".$role);
?>