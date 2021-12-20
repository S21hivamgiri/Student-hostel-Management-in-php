<?php 
    session_start();
   error_reporting(0);
    require_once "../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    $rn = htmlspecialchars($_GET['regno']);
    if($rn)
        $af = $document->findOne(['roll_no'=>$rn]);
    else
       $af = $document->findOne(['username' => $_SESSION['username'], 'password' =>($_SESSION['password'])]);
         $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("01-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
    $file_name = $af['filename'];
    if($file_name == ''){
        $file_name = 'default.png';
    }

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



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="../assets/js/scripts.js"></script>
  </head>
  <body>
    <div class="centerstage row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 infostage">
            <div class="student_profile">
                <div class="container modified">
                <!-- STUDENT VIEW PROFILE SECTION -->

                    <div class="view_profile">
                        <div class="section" id="personal">
                        <br>
                            <div class="section_title">
                                <h1>Personal Information</h1>
                            </div>
                            <div class="img-sec">
                                <img src="../assets/img/Students/<?php echo $file_name?>" height=200 width=150>                           
                            </div>
                            <br>
                            <div class="section_sub_title">
                                <h1>General Information</h1>
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Registration Number</td>
                                        <td><?php $roll= $af['roll_no'];echo $roll; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Course</td>
                                        <td><?php echo $af['course']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dept.</td>
                                        <td><?php echo $af['dept']; ?></td>
                                   </tr>
                                    <tr>
                                        <td>Student Name</td>
                                        <td><?php echo $af['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Joining</td>
                                        <td><?php echo $af['doj']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $af['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td><?php if($result['stuyear'])echo $result['stuyear']; else echo $stuyear ?></td>
                                    </tr>
                                
                                    
                                </tbody>
                            </table>
							<div class="section_sub_title">
                                <h1>Allocation Information</h1>
                            </div>
                            <table class="table table-striped">
                            <?php
                            $room="NA";
                            $host="NA";
                            
                            ?>
                                <tbody>
                                    <tr>
                                        <td>Room Number</td>
                                        <td><?php if($af['room_no'.$semyear]=='')echo "Room Number Not Allocated"; else{ $room=$af['room_no'.$semyear];echo $room;}?></td>
                                    </tr>
                                    <tr>
                                        <td>Floor</td>
                                        <td><?php if($af['floorno'.$semyear]=='')echo "Room Number Not Allocated"; else echo $af['floorno'.$semyear]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hostel</td>
                                        <td><?php if($af['hostelno'.$semyear]=='')echo "Hostel Not Allocated"; else {$host= $af['hostelno'.$semyear]; echo $host;}?></td>
                                    </tr>
                                    <tr>
                                    <td>Roommates</td>
                                    <td>
                                    <?php  
                                    $res= $document->find(['room_no'.$semyear => $room, 'hostelno'.$semyear => $host,'role' =>'Student']);
                                    
                                        foreach($res as $r)
                                        {

                                            if($r['roll_no']!=$roll)
                                            {
                                                echo '<b>'.$r['name'].'</b>  Phone:'.$r['p_mobile'].' ';
                                                
                                            }
                                        }
                                
                                    
                                    ?>
                                       
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
                                        <td><?php echo $af['p_street']; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo $af['p_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <td><?php echo $af['p_district']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo $af['p_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo $af['p_country']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td><?php echo $af['p_pincode']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td><?php echo $af['p_mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $af['p_email']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="section" id="family">
                            <div class="section_sub_title">
                                <h1>Father's Information</h1>
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo $af['f_name']; ?></td>
                                    </tr>
                                
                                    <tr>
                                        <td>Number</td>
                                        <td><?php echo $af['f_number']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $af['f_email']; ?></td>
                                    </tr>
                                                                
                                </tbody>
                            </table>  
                        
                     <a href="alloc_info.php?regno=<?php echo $roll?>"> <input type="button" name="activate-Feed" value="See Allocation Details" class="btn btn-primary img-ctn-btn">
                        </a>
                         <a href="fee_info.php?regno=<?php echo $roll?>"> <input type="button" name="activate-Feed" value="See Fees Details" class="btn btn-primary img-ctn-btn">
                        </a>
                         <a href="view-proof.php?regno=<?php echo $roll?>"> <input type="button" name="activate-Feed" value="See Identity Proof" class="btn btn-primary img-ctn-btn">
                        </a>
                     
                    
                        </div>                    
                    </div>           
                </div>
            </div>
        </div>
    </div>
<script src="../assets/js/scripts.js"></script>
<?php include('../dashboardfooter.php'); ?>