<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
     $collection = $client->hostel;
    $document = $collection->users;

    $updateQuery = $document->updateOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])], 
    ['$set' => ['feed' => "0"]]);
   
?>
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	
    <div class="centerstage row">
        
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 infostage">
            <div class="initiate-file if">
                <div class='alert alert-danger' role='alert'>
					<br>
					<br>
					<br>
                    Feedback Already Submitted !!!
					<br>
					OR
					<br>
					Feedback system is being Deactivated
					
                </div>
            </div>
        </div>
    </div>
<script src="assets/js/scripts.js"></script>