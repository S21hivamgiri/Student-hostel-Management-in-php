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
       if($role="In/Out"){
        $updateQuery = $document->updateOne(['id' => $rid,'role'=>$role], 
        ['$set' => ['in_time' => $it, 'in_date' => $id,'journey'=>'']]);
        }
        else{
            $updateQuery = $document->updateOne(['id' => $rid,'role'=>$role], 
        ['$set' => ['in_time' => $it, 'in_date' => $id]]);
        }
    }
    header("location:outstanding-entry.php?room_select=In/Out");
?>