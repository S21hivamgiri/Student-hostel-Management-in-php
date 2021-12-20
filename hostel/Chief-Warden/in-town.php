<?php
  session_start();
require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result1 = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
if(!$result1){
    header("location:../index.php");
}

$year=date("Y");
$ar=date("y");
$cur_date=date("Y-m-d");
if(strtotime($cur_date)>=strtotime("10-06-".$year))

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
<body lang=EN-US style='tab-interval:36.0pt'>


       <div class="img-ctn-h1">
                <h1>HOSTELLERS OUT IN KARAIKAL</h1>
            </div>
            
            <br>
<?php
$document = $collection->register;
$res = $document->find(['role'=>'In/Out','journey'=>"1"]);

                    
           echo' <table>
           <tr>
     <td class="section_sub_title trans">Name of hosteller</td>
     <td class="section_sub_title trans">Roll Number</td>
     <td class="section_sub_title trans">Reason</td>
     <td class="section_sub_title trans">Room No.</td>
     <td class="section_sub_title trans">Out Date</td>
     <td class="section_sub_title trans">Out Time</td>
     <td class="section_sub_title trans">Phone No</td>
      <td class="section_sub_title trans">Year</td
     
 </tr>';
 

                        foreach ($res as $as) 
                        {
                           
                            
                           
                             
                              echo "
                                  <tr class='pending-list-item'>
                                      <td>". $as['student_name']."</td>
                                       <td >". $as['student_roll_number'] ."</td>
                                       <td >". $as['reason'] ."</td>
                                       <td >". $as['student_room_no'] ."</td>
                                       <td >". $as['out_date'] ."</td>
                                       <td >". $as['out_time'] ."</td>
                                       <td >". $as['student_number'] ."</td>
                                       <td >". $as['sem'] ."</td>
                                       
                                       
                                   </tr>  
                               ";   
                    
                      }
                     
                    echo "</table>";
                    ?>
              
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>