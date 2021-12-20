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
$hostel=$result1['hostelno'];
$year=date("Y");
$ar=date("y");
$cur_date=date("Y-m-d");
if(strtotime($cur_date)>=strtotime("10-06-".$year))

$semyear= $year.'-'.($ar+1);

else
$semyear= ($year-1).'-'.($ar);
$time=date("h:i:s A");
$date=date("Y-m-d");

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
        <div>
            <table>
<div class="img-ctn-h1">
                <h1>ATTENDANCE FOR <?php echo " ".$hostel; ?> on <?php echo $date;?> at <?php echo $time;?></h1>
            </div>
            <?php
             echo '<tr>
             <td class="section_sub_title">Name of student</td>
             <td class="section_sub_title">Roll Number</td>
           <td class="section_sub_title">Course</td>
             <td class="section_sub_title">Room No.</td>
             <td class="section_sub_title">Year</td>
             <td class="section_sub_title">Phone No.</td>
             <td class="section_sub_title">Is Present</td>
  	       
         </tr>';
            $result = $document->find(['hostelno'.$semyear => $hostel]);
            foreach($result as $as)
            {
                if(($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'||$as['role'] == 'student-council'))
                {
                  $document = $collection->leave;
                  $search = $document->findOne(['roll_no'=>$as['roll_no'],'journey'=>1]);
                   $document = $collection->register;
                  $search1 = $document->findOne(['student_roll_number'=>$as['roll_no'],'role'=>'In/Out','journey'=>"1" ]); 
                  
                    if($search)
                    {
                      $color="red";$status="No";
                      $bgcolor="#ffbcbc";
                    }
                    else if($search1)
                    {

                      
                      $color="blue";
    
                                         $status="Within KKl";
                      
                      $bgcolor="#d6faff";
                      
                 }
                    else
                    {
                      $color="green";
                      $bgcolor="#effff4";
                      $status="Yes";
                      
                    }
                    echo "
                        <tr class='pending-list-item'>
                            <td  style='background-color:".$bgcolor."'>". $as['name']."</b></td>
                            <td  style='background-color:".$bgcolor."'><span class='regno'  style='background-color:".$bgcolor."'>". $as['roll_no'] ."</span></b></td>
                            <td  style='background-color:".$bgcolor."'>". $as['course']."</td> 
                            <td  style='background-color:".$bgcolor."'>". $as['room_no'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['stuyear']."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['p_mobile']."</td>
                            <td  style='background-color:".$bgcolor."'><span class='trans' style='font-weight:bold ;color:".$color.";background-color:".$bgcolor."'>". $status."</span></td>
                            </tr>  
                    ";                                 
                }
            }    
                                
?>
</table>
            </div>
            </div>
            </body>
            </html>