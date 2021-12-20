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
            
                   <?php
                    $af=$document->findOne(['roll_no'=>  $_SESSION['roll']]);
                  
                    
                    if(isset($_POST['allocatebtn']))
                    {
                      $document = $collection->users;

                     
                       if($af['stuyear']) $stuyear=$af['stuyear'];
                            else{
                            $t =strtotime($af['doj']);
                            $cur_date=date("Y-m-d");
                            $j_year=date("Y",$t);
                            $ti=strtotime("10-06-".$j_year);
                            $r=strtotime($cur_date);
                            $diff=$r-$ti;
                            $year=$diff/(365*60*24*60);
                            $i=(int) $year+1;
                            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                            if (($i %100) >= 11 && ($i%100) <= 13)
                                $abbreviation = 'th';
                            else
                                $abbreviation = $ends[$i % 10];
                            $stuyear=$i.$abbreviation;
                            
                            }
  
             
                        
                        echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The student ". $_SESSION['roll']. " sucessfully updated with ".$stuyear." year to ".$_POST['year-select']." year.
                            </div>";
                    }
                echo ' 
                            <div class="view_profile">
                            <div class="section" id="personal">
                            <br>
                                <div class="section_title">
                                    <h1>Personal Information</h1>
                                </div>
                                <br><br><br><br>
                                <img src="../assets/img/Students/'.$af['filename'].'" height=200 width=150>
                                <img src="../assets/img/Students/'.$af['proofname'].'" height=200 width=150>
                                
                                <br><br>
                                <div class="section_sub_title">
                                    <h1>General Information</h1>
                                </div>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Registration Number</td>
                                            <td>'.$af['roll_no'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Student Name</td>
                                            <td>'.$af['name'].'</td>
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
                
               ';

                ?>
                 <div class="container">
        <div class="cp">
            <form action="" method="post">
            
					  <div class="form-group">
                    <label for="search">Enter the year of Student</label><br>
                        <select name="year-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        <option value="1st">1</option>
                        <option value="2nd">2</option>
                        <option value="3rd">3</option>
                        <option value="4th">4</option>
                        <option value="5th">5</option>
                        <option value="6th">6</option>
                        <option value="7th">7</option>
                        <option value="8th">8</option>
                    </select> 
                      </div>
                
             
                
                <div class="form-group">
					
                   
                    <center><input type="submit" name="allocatebtn" value="Update Year" class="btn btn-primary"></center>
			</div>
            </form>
            </body>