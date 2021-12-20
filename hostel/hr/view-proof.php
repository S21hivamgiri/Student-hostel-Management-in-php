<?php

 session_start();
 $roll = htmlspecialchars($_GET['regno']);

    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <title></title>
</head>
	<body>

  <?php  
    $result = $document->findOne(['roll_no'=>$roll]);


?>
  <div class="img-sec">
                                <img src="../assets/img/Students/<?php echo $result['proofname'];?>" height=200 width=150>                           
                            </div>
<a href="view-profile.php?regno=<?php echo $roll?>"> <input type="button" name="activate-Feed" value="<<Back" class="btn btn-primary img-ctn-btn">
                        </a>



</body>
</html>