<?php 
    session_start();

 
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    
    $af = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$af){
        header("location:../index.php");
    }
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
                    
                    if(isset($_POST['allocatebtn']))
                    {
                        
                        
                      
                        $_SESSION['month']=  $_POST['month'];
                        $_SESSION['year']=  $_POST['year'];
                        header("location:feedback.php");
                     
                    }

                ?>
                
				
			
				
				<div class="form-group">
                        <label for="search">Enter the Month for which feedback to be viewed</label><br>
                        <select name="month" style=" border-radius:4px;" class="floor-select-st shift-up" required>
                        <option value="" hidden></option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>   
                </div>
                   
                <label for="image_side">Select Year</label>
                    
                    <select name="year" style=" border-radius:4px;" class="floor-select-st shift-up" required>
                    <option value="" hidden></option>
                    <?php 
                        
                       
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->feedback;
                        $allStudents = $document->distinct('year');
                        $count = sizeof($allStudents);
                        for($i =0; $i<$count; $i++)
                            echo "<option value='".$allStudents[$i]."'>".$allStudents[$i]."</option>";
                    ?>
                    </select>
                    <center><input type="submit" name="allocatebtn" value="View Feedback" class="btn btn-primary"></center>
				</div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>