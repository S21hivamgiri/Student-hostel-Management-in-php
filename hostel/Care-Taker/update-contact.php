<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <script src="../assets/js/google/recaptcha/api.js" async defer></script> -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $meal = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$meal){
        header("location:'../index.php");
    }
    $host=$meal['hostelno'];
    
    $document = $collection->emergency;
   
    $findStmt = $document->find(["role"=>"general"]);

    echo '     <table><tr>
    <td class="section_sub_title">Name of Contact</td>
    <td class="section_sub_title">Designation</td>
    <td class="section_sub_title">Email id.</td>
    <td class="section_sub_title">Phone-No.</td>
    <td class="section_sub_title">Remark</td>
    <td class="section_sub_title">Last Updated</td> 
    <td class="section_sub_title">Update Info</td> 
</tr>';
foreach($findStmt as $as)
{
    echo "  
    <tr class='pending-list-item'>
    <form action='emer-update.php?id=". $as['id'] ."' method='POST'>
        <td> <input type='text' class='form-control spec-1' name='emergency-name' value='". $as['name']."'required></td>
        <td> <input type='text' class='form-control spec-1' name='emergency-des' value='". $as['desg'] ."'required></td>
        <td> <input type='text' class='form-control spec-1' name='emergency-email' value='". $as['email'] ."'required></td>
        <td> <input type='text' class='form-control spec-1' name='emergency-num' value='". $as['contact'] ."'required></td>
        <td> <input type='text' class='form-control spec-1' name='emergency-remark' value='". $as['remark'] ."'></td>
        <td> ". $as['upload_date'] ."</td>
        <td><input type='submit' name='updatemer' value='Update Data' class='btn btn-primary img-ctn-btn'><td>
        </form>
    </tr>  
";

}
echo "</table>";
?>  

