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
                <div class="form-group">
                    <label for="image_side">Select Registration Number</label>
                    
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                    <option value="" hidden></option>
                    <?php 
                        
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;

                        $allStudents = $document->find();

                        foreach ($allStudents as $as) {
                            if(substr($as['roll_no'],0,4)=="TEMP")
                            {
                            echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <br>
              
                <br><br><br>
                <center><input type="submit" name="reallocatebtn" value="Show details" class="btn btn-primary"></center>
		
        </form>
    </div> 
      </div>
      </div>
    <div class="container">
        <div>
            <table>
                <?php
                if(isset($_POST['reallocatebtn']))

                {   
                    
                    
                    $af=$document->findOne(['roll_no'=>$_POST['rollno-select']]);
                    $_SESSION['ditto']=substr($af["roll_no"],4,5);
                    $file_name = $af['filename'];
                    if($file_name == ''){
                    $file_name = 'default.png';
                    }
                    if($af['room_no'.$semyear]=='')$roomalloc= "Room Number Not Allocated"; else{ $roomalloc=$af['room_no'.$semyear];}
                    $document = $collection->users;
                    $_SESSION['rollno']=$_POST['rollno-select'];
                    if($af['floorno'.$semyear]=='')$flooralloc= "Room Number Not Allocated"; else $flooralloc= $af['floorno'.$semyear];
            
                    if($af['hostelno'.$semyear]=='')$hostelalloc= "Hostel Not Allocated"; else $hostelalloc= $af['hostelno'.$semyear];
                                echo ' 
                                <div class="view_profile">
                                <div class="section" id="personal">
                                <br>
                                    <div class="section_title">
                                        <h1>Personal Information</h1>
                                    </div>
                                    <img src="../assets/img/Students/'.$file_name.'" height=200 width=150>
                                    <br><br>
                                    <div class="section_sub_title">
                                        <h1>General Information</h1>
                                    </div>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                            <tr>
                                                <td>Student Name</td>
                                                <td><b>'.$af['name'].'</b></td>
                                            </tr>
                                                <td>Registration Number</td>
                                                <td>'.$af['roll_no'].'</td>
                                            </tr>
                                            <tr>
                                            <td>Course</td>
                                            <td>'.$af['course'].'</td>
                                        </tr>
                                        <tr>
                                        <td>Dept</td>
                                        <td>'.$af['dept'].'</td>
                                    </tr>
                                            
                                            <tr>
                                                <td>Date of Joining</td>
                                                <td>'.$af['doj'].'</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>'.$af['gender'].'</td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                    </table>
                                    <div class="section_sub_title">
                                        <h1>Allocation Information</h1>
                                    </div>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Room Number</td>
                                                <td>'.$roomalloc.'</td>
                                            </tr>
                                            <tr>
                                                <td>Floor</td>
                                                <td>'.$flooralloc.'</td>
                                            </tr>
                                            <tr>
                                                <td>Hostel</td>
                                                <td>'.$hostelalloc.'</td>
                                            </tr>
                                            <tr>
                                               
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <div class="section_sub_title">
                                        <h1>Permanent Address</h1>
                                    </div>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Street Name</td>
                                                <td>'.$af['p_street'].'</td>
                                            </tr>
                                            <tr>
                                            <td>City</td>
                                            <td>'.$af['p_city'].'</td>
                                        </tr>
                                        <tr>
                                        <td>Area</td>
                                        <td>'.$af['p_district'].'</td>
                                    </tr>
                                            <tr>
                                                <td>State</td>
                                                <td>'.$af['p_state'].'</td>
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                <td>'.$af['p_country'].'</td>
                                            </tr>
                                            <tr>
                                                <td>Pincode</td>
                                                <td>'.$af['p_pincode'].'</td>
                                            </tr>
                                            <tr>
                                                <td>Mobile Number</td>
                                                <td>'.$af['p_mobile'].'</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>'.$af['p_email'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <form action="" method="post">
                                <div class="form-group">
                                
                                <input type="text" class="form-control" name="newroll" value="'.$_SESSION['ditto'].'"required>
                        
                        <center><input type="submit" name="allocatebtn" value="Rename RollNo" class="btn btn-primary"></center>
                    </div></form>
                                ';}
                  
              if(isset($_POST['allocatebtn']))
              {
                  if($_POST['newroll']==$_SESSION['ditto']) 
                  echo "New Roll No. is required";
                  else{
                  $updateResult = $document->updateOne(
                      ['roll_no' => $_SESSION['rollno']],
                      ['$set' => [
                          'roll_no' =>$_POST['newroll']
                         
                      ]]
                  );

                  echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                          The student ". $_SESSION['rollno']. " has been successfully mapped to roll no. ".  $_POST['newroll']."
                      </div>";
              }
            }
            ?>
            
            </table><br><br><br><br><br>
        </div>
    </div>
</body>

</html>