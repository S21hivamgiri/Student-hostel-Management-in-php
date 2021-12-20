<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$result){
        header("location:../index.php");
    }
    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("01-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);


   
  
?>

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
</head>
<body>
    <div class="container">
        <div class="cp">
            <form action="" method="post">
                <?php 
                   
                    $document = $collection->users;
                    $yeardate=date("Y");
                    $month=date("m");
                    if($month<'06')
                    $sem="Even";
                    else 
                    $sem="Odd";
                    $semyeardate=$sem.$yeardate;
                    if(isset($_POST['rstbtn']))
                    {


                        $updateQuery = $document->updateOne(["role"=>"Student"], 
                        ['$set' => ['paid' => "0"]]);
                        $updateQuery = $document->updateOne(["role"=>"hr"], 
                        ['$set' => ['paid' => "0"]]);
                        $updateQuery = $document->updateOne(["role"=>"mr"], 
                        ['$set' => ['paid' => "0"]]);
                        $updateQuery = $document->updateOne(["role"=>"student-council"], 
                        ['$set' => ['paid' => "0"]]);
                        


                    }
                    
                  
                ?>
                
				
				<div class="form-group">
                    <label for="image_side">Reset the payment made in the semester</label>
                     
                
                   
                    <center><input type="submit" name="rstbtn" value="Reset Payment for next Sem" class="btn btn-primary"></center>
				</div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>