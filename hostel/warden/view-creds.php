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
                <h1>VIEW REPRESENTATIVES</h1>
            </div>
            <?php
             echo '<tr>
             <td class="section_sub_title">Name of student</td>
             <td class="section_sub_title">Roll Number</td>
             <td class="section_sub_title">Hostel</td>
             <td class="section_sub_title">Room No.</td>
             <td class="section_sub_title">Year</td>
             <td class="section_sub_title">Phone No.</td>
             <td class="section_sub_title">Present/Absent</td>
  	       
         </tr>';
            $result = $document->find(['role'=>'student-council']);
            foreach($result as $as)
            {
               
                
                   $role="Student Council";
                    
                      $color="green";
                      $bgcolor="#effff4";
                    
                    echo "
                        <tr class='pending-list-item'>
                            <td  style='background-color:".$bgcolor."'>". $as['name']."</b></td>
                            <td  style='background-color:".$bgcolor."'><span class='regno'  style='background-color:".$bgcolor."'>". $as['roll_no'] ."</span></b></td>
                            
                            <td  style='background-color:".$bgcolor."'>". $as['room_no'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['hostelno'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['stuyear']."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['p_mobile']."</td>
                            <td  style='background-color:".$bgcolor."'><span class='trans' style='font-weight: bold;color:".$color.";background-color:".$bgcolor."'>". $role."</span></td>
                            </tr>  
                    ";                        
                         
                
            }    
             $result = $document->find(['role'=>'mr']);
            foreach($result as $as)
            {
              
                    $role="Mess Representative";
                    
                      $color="red";
                      $bgcolor="#ff918c";
                    
                    echo "
                        <tr class='pending-list-item'>
                            <td  style='background-color:".$bgcolor."'>". $as['name']."</b></td>
                            <td  style='background-color:".$bgcolor."'><span class='regno'  style='background-color:".$bgcolor."'>". $as['roll_no'] ."</span></b></td>
                            
                            <td  style='background-color:".$bgcolor."'>". $as['room_no'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['hostelno'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['stuyear']."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['p_mobile']."</td>
                            <td  style='background-color:".$bgcolor."'><span class='trans' style='font-weight: bold;color:".$color.";background-color:".$bgcolor."'>". $role."</span></td>
                            </tr>  
                    ";                        
             
            }    
            $result = $document->find(['role'=>'hr']);
            foreach($result as $as)
            {
                
                
                    $role="Hostel Representative";
                    
                      $color="#0026ff";
                      $bgcolor="#8799ff";
                    
                    echo "
                        <tr class='pending-list-item'>
                            <td  style='background-color:".$bgcolor."'>". $as['name']."</b></td>
                            <td  style='background-color:".$bgcolor."'><span class='regno'  style='background-color:".$bgcolor."'>". $as['roll_no'] ."</span></b></td>
                            
                            <td  style='background-color:".$bgcolor."'>". $as['room_no'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['hostelno'.$semyear]."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['stuyear']."</td>
                            <td  style='background-color:".$bgcolor."'>". $as['p_mobile']."</td>
                            <td  style='background-color:".$bgcolor."'><span class='trans' style='font-weight: bold; color:".$color.";background-color:".$bgcolor."'>". $role."</span></td>
                            </tr>  
                    ";                        
              
            }    
                                
?>
</table>
            </div>
            </div>
            </body>
            </html>