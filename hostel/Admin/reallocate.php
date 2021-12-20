<?php 
    session_start();
 
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);

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
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="search-bar">
        <div class="section_title_h1">
            <h1>Search Student</h1>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="image_side">Select Registration Number</label>
                    
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                    <option value="" hidden></option>
                    <?php 
                        
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;

                        $allStudents = $document->find([
                            'course' =>  $_SESSION['course'],
                            'dept' =>  $_SESSION['dept'], 
                            'hosteller' => 1
                           ]);

                        foreach ($allStudents as $as) {
                            if(($as['role'] == 'Student'  || $as['role'] == 'hr' || $as['role'] == 'mr')&& $as['room_no'.$semyear]!='')
                            {
                            echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <br>
                </div></div>
                <br><br><br>
                <center><input type="submit" name="reallocatebtn" value="ReAllocate Room" class="btn btn-primary"></center>
		
        </form>
    </div> 
    <div class="container">
        <div>
            <table>
            <?php 
              if(isset($_POST['allocatebtn']))
              {
                  
                  $result = $document->findOne(['roll_no' => $_SESSION['rollno']]);
                  if($_POST['floor-select']=='G')$floor="Ground";
                  else if($_POST['floor-select']=='F')$floor="First";
                  else if($_POST['floor-select']=='S')$floor="Second";
                  else if($_POST['floor-select']=='T')$floor="Third";
                  else if($_POST['floor-select']=='R')$floor="Fourth";
                  if($_POST['floor-select']=='G' && $_POST['roomNo']>39)
                        {
                            echo "In Ground floor Room Ranges from G1 to G39";
                        }
                        else{
                  $room= $_POST['floor-select'].$_POST['roomNo'];
                  $updateResult = $document->updateOne(
                      ['roll_no' => $_SESSION['rollno']],
                      ['$set' => [
                          'room_no'.$semyear =>$room,
                          'floorno'.$semyear => $floor,
                          'hostelno'.$semyear => $_POST['hostel-select']
                      ]]
                  );

                
                

                  echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                          The student ". $_SESSION['rollno']. " has been successfully allocated to ".$room.".in ".  $_POST['hostel-select']."
                      </div>";
              }
            }
                
                if(isset($_POST['reallocatebtn']))
                {   $client = (new MongoDB\Client);
                    $collection = $client->hostel;
                    $document = $collection->users;
                    $_SESSION['rollno']=$_POST['rollno-select'];
                     
                    $allStudents = $document->find();

                        foreach($allStudents as $as)
                        {
                                if(($as['role'] == 'Student'  || $as['role'] == 'hr' || $as['role'] == 'mr') && $as['room_no'.$semyear]!=''&& $as['roll_no']==$_SESSION['rollno'])
                                {

                                

                                echo ' 
                                <h4>Previously '.$_SESSION['rollno'].' allotted to: </h4>'.' '. $as["room_no".$semyear].'  of '.$as["hostelno".$semyear].' 
                                
                                <form action="" method="post">
                                <div class="form-group">
                                <label for="search">Enter New Room Number</label><br>
                                <select name="floor-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                                <option value="" hidden></option>
                                <option value="G">G</option>
                                <option value="F">F</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="R">R</option>
                            </select>   
                            
                                <input type="number" class="form-control" min="1" max="43" name="roomNo" placeholder="Enter Room Number"required>
                        </div>
                        <div class="form-group">
                        <label for="search">Select Hostel</label>
                        <select name="hostel-select" style=" border-radius:4px;" class="floor-select-st shift-up" required>
                           ';

                        
 $document = $collection->academics;
  $find=$document->find(['role'=>'hostel']);  
    
    
        foreach($find as $as)
        {
        echo "<option value=".$as['hostel'].">".$as['hostel']."</option>";
        }
    
                           
                           echo'
                        </select>
                        <center><input type="submit" name="allocatebtn" value="Allocate Room" class="btn btn-primary"></center>
                    </div></form>
                                ';
                                }     
                        }
                }
            ?>
            </table>
        </div>
    </div>
</body>

</html>