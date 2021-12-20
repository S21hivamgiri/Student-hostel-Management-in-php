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
    //error_reporting(0);

   
$af = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
if(!$af){
    header("location:../index.php");
}
    $host=$af['hostelno'];
    
    $document = $collection->emergency;
    $findStmt = $document->find(["role"=>"general"]);

    echo '<table><tr>
    <td class="section_sub_title">Name of Contact</td>
    <td class="section_sub_title">Designation</td>

    <td class="section_sub_title">Email id.</td>
    <td class="section_sub_title">Phone-No.</td>    <td class="section_sub_title">Remark</td>
    <td class="section_sub_title">Last Updated</td> 
</tr>';
foreach($findStmt as $as)
{
    echo "
    <tr class='pending-list-item'>
        <td>". $as['name']."</td>
        <td>". $as['desg'] ."</span></td>
        <td>". $as['email'] ."</td>
        <td>". $as['contact'] ."</td>
        <td>". $as['remark'] ."</td>
        <td>". $as['upload_date'] ."</td>
    </tr>  
";

}
echo "</table>";
?>  

