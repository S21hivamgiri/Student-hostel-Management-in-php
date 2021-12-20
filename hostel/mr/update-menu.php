<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $meal = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$meal){
        header("location:index.php");
    }
      $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("10-06-".$year))
    $semyear= $year.'-'.($ar+1);
    else
    $semyear= ($year-1).'-'.($ar);
    $host=$meal['hostelno'.$semyear];
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->menu;
    $meal = $document->findOne(['hostelno'=>$host]);
  
?>  

    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <div class="centerstage row">
       
            <div class="container">
                <div class="feedback">
                    <form action="" method="POST">
                   
                    <?php 
                       
                        
                        $count= $document->count(['hostelno'=>$host]);
                      
                        if(isset($_POST['giveFeed']))
                        {
                            
                            $v01 = $_POST['Bdail_value'];
                            $v02 = $_POST['Ldail_value'];
                            $v03 = $_POST['Ddail_value'];
                            $v04 = $_POST['Bmon_value'];
                            $v05 = $_POST['Lmon_value'];
                            $v06 = $_POST['Dmon_value'];
                            $v07 = $_POST['Btues_value'];
                            $v08 = $_POST['Ltues_value'];
                            $v09 = $_POST['Dtues_value'];
                            $v10 = $_POST['Bwed_value'];
                            $v11 = $_POST['Lwed_value'];
                            $v12 = $_POST['Dwed_value'];
							$v13 = $_POST['Bthurs_value'];
                            $v14 = $_POST['Lthurs_value'];
                            $v15 = $_POST['Dthurs_value'];
                            $v16 = $_POST['Bfri_value'];
                            $v17 = $_POST['Lfri_value'];
                            $v18 = $_POST['Dfri_value'];
                            $v19 = $_POST['Bsat_value'];
                            $v20 = $_POST['Lsat_value'];
                            $v21 = $_POST['Dsat_value'];
                            $v22 = $_POST['Bsun_value'];
                            $v23 = $_POST['Lsun_value'];
                            $v24 = $_POST['Dsun_value'];
                            $v25 = $_POST['Sdail_value'];
                            $v26 = $_POST['Smon_value'];
                            $v27 = $_POST['Stues_value'];
                            $v28 = $_POST['Swed_value'];
                            $v29 = $_POST['Sthurs_value'];
                            $v30 = $_POST['Sfri_value'];
                            $v31 = $_POST['Ssat_value'];
                            $v32 = $_POST['Ssun_value'];
                            $f1=$_POST['Bfromtime'];
                                $f2=$_POST['Lfromtime'];
                                $f3=$_POST['Sfromtime'];
                                $f4=$_POST['Dfromtime'];
                                $t1=$_POST['Btotime'];
                                $t2=$_POST['Ltotime'];
                                $t3=$_POST['Stotime'];
                                $t4=$_POST['Stotime'];
                            $last_date = date("l d-m-Y");
                           
                            
                            if( $count==0){
                            $insertStmt = $document->insertOne([
								'hostelno' =>$host,
                                'e1' => $v01, 
                                'e2' => $v02, 
                                'e3' => $v03, 
                                'e4' => $v04, 
                                'e5' => $v05, 
                                'e6' => $v06, 
                                'e7' => $v07, 
                                'e8' => $v08, 
                                'e9' => $v09, 
                                'e10' => $v10, 
                                'e11' => $v11,
                                'e12' => $v12, 
                                'e13' => $v13, 
                                'e14' => $v14, 
                                'e15' => $v15, 
                                'e16' => $v16, 
                                'e17' => $v17, 
                                'e18' => $v18, 
                                'e19' => $v19, 
                                'e20' => $v20, 
                                'e21' => $v21, 
                                'e22' => $v22, 
                                'e23' => $v23,
                                'e24' => $v24,
                                'e25' => $v25, 
                                'e26' => $v26, 
                                'e27' => $v27, 
                                'e28' => $v28, 
                                'e29' => $v29, 
                                'e30' => $v30, 
                                'e31' => $v31,
                                'e32' => $v32,
                                'ldate' => $last_date,
                                'f1'=>$f1,
                                'f2'=>$f2,
                                'f3'=>$f3,
                                'f4'=>$f4,
                                't1'=>$t1,
                                't2'=>$t2,
                                't3'=>$t3,
                                't4'=>$t4
                            ]);

                            header("location:newmenusuccess.php");
                            }
                            else  if( $count==1)
                            {
                            
                                                              
                                $updateQuery = $document->updateOne(['hostelno' => $host], 
                                ['$set' => [  
                                'e1' => $v01, 
                                'e2' => $v02, 
                                'e3' => $v03, 
                                'e4' => $v04, 
                                'e5' => $v05, 
                                'e6' => $v06, 
                                'e7' => $v07, 
                                'e8' => $v08, 
                                'e9' => $v09, 
                                'e10' => $v10, 
                                'e11' => $v11,
                                'e12' => $v12, 
                                'e13' => $v13, 
                                'e14' => $v14, 
                                'e15' => $v15, 
                                'e16' => $v16, 
                                'e17' => $v17, 
                                'e18' => $v18, 
                                'e19' => $v19, 
                                'e20' => $v20, 
                                'e21' => $v21, 
                                'e22' => $v22, 
                                'e23' => $v23,
                                'e24' => $v24,
                                'e25' => $v25, 
                                'e26' => $v26, 
                                'e27' => $v27, 
                                'e28' => $v28, 
                                'e29' => $v29, 
                                'e30' => $v30, 
                                'e31' => $v31,
                                'e32' => $v32,
                                'f1'=>$f1,
                                'f2'=>$f2,
                                'f3'=>$f3,
                                'f4'=>$f4,
                                't1'=>$t1,
                                't2'=>$t2,
                                't3'=>$t3,
                                't4'=>$t4,
                                
                                'ldate' => $last_date
                                ]]);
                               header("location:newmenusuccess.php");
                            }
                        }
                    ?>
                        <div class="section_sub_title spread">
                            <h1>Change the menu for <?php echo $host?></h1>
                        </div>
						
					
                        <div class="questionBank">
                            <table class="questionTable">
                                <thead>
                                    <tr class="firstRow">
                                        <th></th>
                                        <th>BREAKFAST</th>
                                        <th>LUNCH</th>
                                        <th>SNACKS</th>
                                        <th>DINNER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>DAILY</td>
                                        <td> <textarea cols="30" rows="3" class="field-value" name="Bdail_value"  required><?php echo $meal['e1'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Ldail_value" required><?php echo $meal['e2'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Sdail_value" required><?php echo $meal['e25'];?></textarea></td>
                                        
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Ddail_value" required><?php echo $meal['e3'];?></textarea></td>
                                    </tr>
                                    <tr>
                                         <td>MONDAY</td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Bmon_value" required><?php echo $meal['e4'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Lmon_value" required><?php echo $meal['e5'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Smon_value" required><?php echo $meal['e26'];?></textarea></td>
                                       <td><textarea cols="30" rows="3"  class="field-value" name="Dmon_value" required><?php echo $meal['e6'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>TUESDAY</td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Btues_value" required><?php echo $meal['e7'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Ltues_value" required><?php echo $meal['e8'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Stues_value" required><?php echo $meal['e27'];?></textarea></td>
                                       <td><textarea cols="30" rows="3"  class="field-value" name="Dtues_value" required><?php echo $meal['e9'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>WEDNESDAY</td>
										<td><textarea cols="30" rows="3"   class="field-value" name="Bwed_value" required><?php echo $meal['e10'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Lwed_value" required><?php echo $meal['e11'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Swed_value" required><?php echo $meal['e28'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Dwed_value" required><?php echo $meal['e12'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>THURSDAY</td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Bthurs_value" required><?php echo $meal['e13'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Lthurs_value" required><?php echo $meal['e14'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Sthurs_value" required><?php echo $meal['e29'];?></textarea></td>
                                       <td><textarea cols="30" rows="3"  class="field-value" name="Dthurs_value" required><?php echo $meal['e15'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>FRIDAY</td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Bfri_value" required><?php echo $meal['e16'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Lfri_value" required><?php echo $meal['e17'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Sfri_value" required><?php echo $meal['e30'];?></textarea></td>
                                       <td><textarea cols="30" rows="3"   class="field-value" name="Dfri_value" required><?php echo $meal['e18'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>SATURDAY</td>
                                      <td><textarea cols="30" rows="3"   class="field-value" name="Bsat_value" required><?php echo $meal['e19'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Lsat_value" required><?php echo $meal['e20'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Ssat_value" required><?php echo $meal['e31'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"   class="field-value" name="Dsat_value" required><?php echo $meal['e21'];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>SUNDAY</td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Bsun_value" required><?php echo $meal['e22'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Lsun_value" required><?php echo $meal['e23'];?></textarea></td>
                                        <td> <textarea cols="30" rows="3"  class="field-value" name="Ssun_value" required><?php echo $meal['e32'];?></textarea></td>
                                        <td><textarea cols="30" rows="3"  class="field-value" name="Dsun_value" required><?php echo $meal['e24'];?></textarea></td> </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                         <div class="section_sub_title spread">
<h1>Hostel's Mess Timing</h1>
</div>
                        <div class="mess-time">


                       <hr>
                       <table>
                        <thead>
                             <tr class="firstRow">
                                 <td></td>
                                 <td><b>BREAKFAST</b></td>
                                 <td><b>LUNCH</b></td>
                                 <td><b>SNACKS</b></td>
                                  <td><b>DINNER</b></td>
                             </tr>
                             </thead>
                             <tr>
<td><b>FROM</b></td>

<td><input type="time" class="lost" min="06:00" max="23:00" name="Bfromtime" value="<?php echo $meal['f1'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Lfromtime" value="<?php echo $meal['f2'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Sfromtime" value="<?php echo $meal['f3'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Dfromtime" value="<?php echo $meal['f4'];?>" required></td>

</tr>
<tr>
<td><b>TO</b></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Btotime" value="<?php echo $meal['t1'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Ltotime" value="<?php echo $meal['t2'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Stotime" value="<?php echo $meal['t3'];?>" required></td>
<td><input type="time" class="lost" min="06:00" max="23:00" name="Dtotime" value="<?php echo $meal['t4'];?>" required></td>

</tr>
</table>

    </div>
                        <input type="submit" name="giveFeed" value="Update Menu" class="btn btn-primary img-ctn-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="assets/js/scripts.js"></script>
