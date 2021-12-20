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
    $_SESSION['hostel']=$result['hostelno'];
    ?>  
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <script src="../assets/js/google/recaptcha/api.js" async defer></script> -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
        <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <div class="centerstage row">
            <div class="feedback">
            
                     <div class="row scoreMeasure" style='background-color:#ffc107;position:relative'>
                        <div class="col-lg-6 btn btn-warning">
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Excellent: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/best.png" >5 Points</span></p>  
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Average: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/sad.png" >2 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Poor: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/sadest.png" >1 Points</span></p>
                        </div>
                        <div class="col-lg-6 btn btn-warning">
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Very Good: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/happy.png" >4 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Good: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/avg.png" >3 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Very Poor: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/worsen.png" >0 Points</span></p>
                        </div>
                    </div>
     
          

                        <table class="questionTable">
                            <thead>
                                <tr class="firstRow">
                                    <td><b>SNo.</b></td>
                                    <td><b>Feedback Category</b></td>
                                    <td><b>Avg Points (out of 5)</b></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 


                                
                        
                                $document = $collection->feedback;
                          
                                $allFiles = $document->find(['year'=>$_SESSION['year'],'month'=>$_SESSION['month'],'hostel'=>$_SESSION['hostel']]);
                                $feedcount = $document->count(['year'=>$_SESSION['year'],'month'=>$_SESSION['month'],'hostel'=>$_SESSION['hostel']]);
                                $yes_count = 0;
                                $no_count = 0;
                                $veg_count=0;$egg_count=0;$non_count=0;
                                $q1_total = $q2_total = $q3_total = $q4_total = 0;
                                $q5_total = $q6_total = $q7_total = $q8_total = 0;
                                $q9_total = $q10_total = $q11_total = $q12_total = 0;

                                foreach ($allFiles as $af) 
                                {
                                    $q1_total += $af['q1'];
                                    $q2_total += $af['q2'];
                                    $q3_total += $af['q3'];
                                    $q4_total += $af['q4'];
                                    $q5_total += $af['q5'];
                                    $q6_total += $af['q6'];
                                    $q7_total += $af['q7'];
                                    $q8_total += $af['q8'];
                                    $q9_total += $af['q9'];
                                    $q10_total += $af['q10'];
                                    $q11_total += $af['q11'];
                                    $q12_total += $af['q12'];
                                    
                                 
                                    if($af['poll'] == "No")
                                        $no_count++;
                                    else
                                        $yes_count++;
                                        if($af['veg']=="vegetarian")
                                        $veg_count++;
                                        else if($af['veg']=="eggetarian")
                                        $egg_count++;
                                        else if($af['veg']=="non-vegetarian")
                                        $non_count++;

                                }
                                $Q=array();
                                   $Q[1] = $q1_total / $feedcount;
                                    $Q[2] = $q2_total / $feedcount;
                                    $Q[3] = $q3_total / $feedcount;
                                    $Q[4] = $q4_total / $feedcount;
                                    $Q[5] = $q5_total / $feedcount;
                                    $Q[6] = $q6_total / $feedcount;
                                    $Q[7] = $q7_total / $feedcount;
                                    $Q[8] = $q8_total / $feedcount;
                                    $Q[9] = $q9_total / $feedcount;
                                    $Q[10] = $q10_total / $feedcount;
                                    $Q[11] = $q11_total / $feedcount;
                                    $Q[12] = $q12_total / $feedcount;
                                   
                                    for($i=1;$i<=12;++$i)
                                    {
                                        if($Q[$i]==0)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/anger.png" >';
                                        else if($Q[$i]==5)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/god.png" >';
                                        else if($Q[$i]<=1)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/worsen.png" >';
                                        else if($Q[$i]<=2)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/sad.png" >';
                                        else if($Q[$i]<=3)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/avg.png" >';
                                        else if($Q[$i]<=4)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/happy.png" >';
                                        else if($Q[$i]<=5)$emoji[$i]='<img class="img-emoji" src="../assets/img/emojis/best.png" >';


                                    }
                                $yes_perc = ($yes_count / ($no_count + $yes_count)) * 100;
                                if($yes_perc>=50)$imgyn='<img class="img-emoji" src="../assets/img/emojis/yes.png" >';
                                else $imgyn='<img class="img-emoji" src="../assets/img/emojis/no.png" >';
                            ?>
                                <tr>
                                    <td>1.</td>
                                    <td>Quality of Food Served</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q1_value" value="<?php echo $Q[1];?>" readonly></td>
                                    <td><?php echo $emoji[1];?></td>   
                                    </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Taste of Food</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q2_value" value="<?php echo $Q[2];?>" readonly></td>
                                     <td><?php echo $emoji[2];?></td>   
                                    
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Cleanliness of Dining and Food Counter Area</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q3_value" value="<?php echo $Q[3];?>" readonly></td>
                                 <td><?php echo $emoji[3];?></td>   
                                </tr>
                                <tr>
                                    <td >4.</td>
                                    <td>Cleanliness of Wash Basins</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q4_value" value="<?php echo $Q[4];?>" readonly></td>
                                 <td><?php echo $emoji[4];?></td>   
                                    
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Cleanliness of Catering Staff</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q5_value" value="<?php echo $Q[5];?>" readonly></td>
                                 <td><?php echo $emoji[5];?></td>   
                                    </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Cleanliness of Utensils</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q6_value" value="<?php echo $Q[6];?>" readonly></td>
                                 <td><?php echo $emoji[6];?></td>   
                                    </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Courtesy of Catering Staff</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q7_value" value="<?php echo $Q[7];?>" readonly></td>
                                 <td><?php echo $emoji[7];?></td>   
                                    
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>Rush and Waiting time at the Food Counters (Note: Give low points if the waiting time is more and give high points if the waiting time is less)</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q8_value" value="<?php echo $Q[8];?>" readonly></td>
                                 <td><?php echo $emoji[8];?></td>   
                                    </tr>
                                <tr>
                                    <td>9.</td>
                                    <td>Serving of Drinking Water in Dining Area</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q9_value" value="<?php echo $Q[9];?>" readonly></td>
                                 <td><?php echo $emoji[9];?></td>   
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <td>Adequate Quantity of Food Provided</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q10_value" value="<?php echo $Q[10];?>" readonly></td>
                                <td><?php echo $emoji[10];?></td>   
                                    
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <td>Waste Disposal Methodology</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q11_value" value="<?php echo $Q[11];?>" readonly></td>
                                 <td><?php echo $emoji[11];?></td>   
                                    
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <td>Service and Punctuality</td>
                                    <td><input type="number" class="field-value btn btn-warning" name="q12_value" value="<?php echo $Q[12];?>" readonly></td>
                                 <td><?php echo $emoji[12];?></td>   
                                    
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <?php echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                               <p class='trans'>People in favour of current mess:". $yes_perc."%
                               ".$imgyn."</p>
                               <p class='trans'>Number of feedback recieved:". $feedcount."</p>
                            <img class='img-emoji' src='../assets/img/emojis/veg.png'>Pure Vegetarian: ".$veg_count."<br>
                            <img class='img-emoji' src='../assets/img/emojis/egg.png'>Eggetarian: ".$egg_count."<br>
                            <img class='img-emoji' src='../assets/img/emojis/non.png'>Non-Vegetarian: ".$non_count."<br>
                               </div>";
                            
                            ?>
                            
                            <form action="" method="POST">
                           <div class="form-group">
                       
                      <a href="exportdata.php"> <input type="button" name="course" value="Print To CSV" class="btn btn-primary img-ctn-btn"></a>
                      </div>
                      </form>
                    


                        <br>
                    </div>
                </div>
            </div>

    </div>
<script src="../assets/js/scripts.js"></script>