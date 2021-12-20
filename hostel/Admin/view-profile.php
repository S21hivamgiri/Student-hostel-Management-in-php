<?php 
 session_start();
 require_once "../vendor/autoload.php";
 date_default_timezone_set("Asia/Kolkata");
 error_reporting(0);
 
 $client = (new MongoDB\Client);
 $collection = $client->hostel;
 $document = $collection->users;
 $rn = htmlspecialchars($_GET['wegno']);
 if($rn)
 $result = $document->findOne(['wdn_id'=>$rn]);
else
 $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
 if(!$result){
     header("location:../index.php");
 }
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
                    <div class="view_profile">
                        <div class="section" id="personal">
                        <?php 
                            $client = (new MongoDB\Client);
                            $collection = $client->hostel;
                            $document = $collection->users;
                            $af = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
                            $file_name = $af['filename'];
                            if($file_name == ''){
                                $file_name = 'default.png';
                            }

                        ?>
                        <br>
                            <div class="section_title">
                                <h1>Personal Information</h1>
                            </div>
                            <div class="img-sec">
                                <img src="../assets/img/Warden/<?php echo $file_name?>" height=200 width=150>
                            </div>
                            <br><br>
                            <div class="section_sub_title">
                                <h1>General Information</h1>
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Registration Number</td>
                                        <td><?php echo $af['wdn_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo $af['name']; ?></td>
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
                                        <td>Area</td>
                                        <td><?php echo $af['p_area']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo $af['p_city']; ?></td>
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
                                        <td>Email Id</td>
                                        <td><?php echo $af['p_email']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>                
                    </div>           
                </div>
            </div>
        </div>
    </div>
<script src="../assets/js/scripts.js"></script>
<?php include('../dashboardfooter.php'); ?>