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
                   
                    $document = $collection->users;
                    $yeardate=date("Y");
                    $month=date("m");
                    if($month<'06')
                    $sem="Even";
                    else 
                    $sem="Odd";
                    $semyeardate=$sem.$yeardate;
                
                        $document = $collection->users;
                        $allStudents = $document->find(
                        [
                         'course' =>  $_SESSION['course'],
                         'dept' =>  $_SESSION['dept'], 
                         'hosteller' => 1
                        ]
                    );echo '  <h1>FEES DETAILS FOR '. $_SESSION['dept'].' of '. $_SESSION['year'].' in  '. $_SESSION['course'].'</h1>'; 
                 
        
           echo' <table>
           <tr>
     <td class="section_sub_title trans">Name of student</td>
     <td class="section_sub_title trans">Roll Number</td>
     <td class="section_sub_title trans">Paid</td>
     <td class="section_sub_title trans">Mode of Payment</td>
     <td class="section_sub_title trans">Amount</td>
     <td class="section_sub_title trans">Paid on</td>
     <td class="section_sub_title trans">Ref_id</td>
     <td class="section_sub_title trans">Ref_id1</td>
     <td class="section_sub_title trans">Ref_id2</td>
     
 </tr>';
                        foreach ($allStudents as $as) 
                        {
                           
                            if($as['stuyear']) 
                                $stuyear=$as['stuyear'];
                            else{
                            $t =strtotime($as['doj']);
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
                            
                            
                            
                            
                             if(($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr' ||$as['role'] == 'student-council')&& $as['room_no'.$semyear]!='' &&   $stuyear==$_SESSION['year'] )
                             {
                             
                              $document = $collection->fees;
                              $search = $document->findOne(['roll_no'=>$as['roll_no'],'recent'=>$semyeardate],['sort'=>['roll_no'=>-1]]);
                            
                               if($as['paid']==0)
                               {
                                 $color="red";$status="No";
                                 $bgcolor="#ffbcbc";
                               }
                               else  if($as['paid']==1)
                               {
                                 $color="green";$status="Yes";
                                 $bgcolor="#effff4";
                               }
                               if($search['ref_number1'.$semyeardate]=='')$fee2='-';else $fee2=$search['ref_number1'.$semyeardate]; 
                               if($search['ref_number2'.$semyeardate]=='')$fee3='-';else $fee3=$search['ref_number1'.$semyeardate]; 
                              
                               echo "
                                  <tr class='pending-list-item'>
                                      <td style='background-color:".$bgcolor." !important;'>". $as['name']."</td>
                                       <td style='background-color:".$bgcolor." !important;'><span class='regno' style='background-color:".$bgcolor." !important;'>". $as['roll_no'] ."</span></td>
                                       
                                       <td style='background-color:".$bgcolor." !important;'><span class='trans' style='color:".$color."'>". $status."</span></td>
                                       <td style='background-color:".$bgcolor." !important;'>". $search['pay_mode'.$semyeardate]."</td>
                                        <td style='background-color:".$bgcolor." !important;'>". $search['amount'.$semyeardate]."</td>
                                    
                                       <td style='background-color:".$bgcolor." !important;'>". $search['paid_on'.$semyeardate]."</td>
                                      
                                       <td style='background-color:".$bgcolor." !important;'>". $search['ref_number'.$semyeardate]."</td>
                                       <td style='background-color:".$bgcolor." !important;'>".$fee2 ."</td>
                                       <td style='background-color:".$bgcolor." !important;'>".$fee3."</td>
                                      
                                       
                                   </tr>  
                               ";   
                    
                            
                   
                        
                        
                        
                        
                      }
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