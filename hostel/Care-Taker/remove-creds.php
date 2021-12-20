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
                   
             
                    
                    if(isset($_POST['allocatebtn']))
                    {
                       
                
                        $roll=$_POST['rollno-select'];
                      
                        $document = $collection->users;
                        $updateQuery = $document->updateOne(["roll_no"=>$_POST['rollno-select']], 
                        [ '$set' =>[ 'role'=>'Student']]);
                        
                        echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The student ". $roll. " sucessfully updated as  a Student.
                            </div>";
                    
                }
                ?>
                
				
				<div class="form-group">
                    <label for="image_side">Select Registration Number(* only allocated and verified students are displayed)</label>
                     
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"  required>
                    <option value="" hidden></option> 
                    <?php  
                        $document = $collection->users;
                        $allStudents = $document->find();

                        foreach ($allStudents as $as) 
                        { 
                            
                            if($as['role'] == 'mr'||$as['role'] == 'hr'|| $as['role'] == 'student-council')
                            {
                            echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <br>
                </div>
				
                <div class="form-group">
					
                   
                    <center><input type="submit" name="allocatebtn" value="Remove Credentials" class="btn btn-primary"></center>
			
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>