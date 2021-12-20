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
              
                    
                    if(isset($_POST['allocatebtn']))
                    {
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->fees;
                    
   
                        if($result)
                        {
                        $roll=$_POST['rollno-select'];
                        $insertResult = $document->insertOne(
                            ['roll_no' => $_POST['rollno-select'],
                                'pay_mode'.$semyeardate=>$_POST['t_mode'],
                                'dept'=> $_SESSION['dept'],
                                'course'=> $_SESSION['course'],
                                'ref_number'.$semyeardate=>$_POST['t_number'],
                                'ref_number1'.$semyeardate=>$_POST['t_number1'],
                                'ref_number2'.$semyeardate=>$_POST['t_number2'],
                                'amount'.$semyeardate=>$_POST['t_amount'],
                                'paid_on'.$semyeardate=>$_POST['t_date'],
                                'recent'=>$semyeardate
                                
                            ]
                        );
                        $document = $collection->users;
                        $updateQuery = $document->updateOne(["roll_no"=>$_POST['rollno-select']], 
                        ['$set' => ['paid' => "1"]]);
                        
                        echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The student ". $roll. " sucessfully paid payment on ".$_POST['t_date']." amounting ".$_POST['t_amount']."
                                 with referance number ".$_POST['t_number'].".
                            </div>";
                    }
                }
                ?>
                
				
				<div class="form-group">
                    <label for="image_side">Select Registration Number(* only allocated and verified students are displayed)</label>
                     
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"  required>
                    <option value="" hidden></option> 
                    <?php  
                        $document = $collection->users;
                        $allStudents = $document->find(
                        [
                         'course' =>  $_SESSION['course'],
                         'dept' =>  $_SESSION['dept'], 
                         'paid' => 0,
                         'hosteller' => 1
                        ]
                    );

                        foreach ($allStudents as $as) 
                        {
                           
                             if($as['stuyear']) $stuyear=$as['stuyear'];
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
                  
                            
                            
                            if(($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr')&& $as['room_no'.$semyear]!='' &&   $stuyear==$_SESSION['year'] )
                            {
                            echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <br>
                </div>
				
				<div class="form-group">
                        <label for="search">Enter Mode of Payment</label><br>
                        <select name="t_mode" style=" border-radius:4px;" class="floor-select-st shift-up" required>
                        <option value="" hidden></option>
                        <option value="Demand_Draft">Demand draft</option>
                        <option value="Net_Banking">Net Banking</option>
                        <option value="Debit_Card">Debit Cards</option>
                        <option value="Others">Others</option>
                    </select>   
                
                </div>
                    <div class="form-group">
                    <label for="search">Sem:<p><?php echo $sem;if($sem=='odd')echo"(July-December)";else echo"(January-May)";?></p></label>
                    </div>
                    <div class="form-group">
                    <label for="search">Year:<p><?php echo $yeardate;?></p></label>
                    </div>
                    <div class="form-group">
                    <label for="search">Enter Payment Reference Number/ Transactional Number </label><br>
                        <input type="text" class="form-control"  name="t_number" placeholder="Enter Tranasactional Number"  required>
                        <input type="text" class="form-control"  name="t_number1" value="" placeholder="Enter Tranasactional Number if paid in second installment" >
                        <input type="text" class="form-control"  name="t_number2" value="" placeholder="Enter Tranasactional Number of fine"  >
               
                
                
                </div>
                
                <div class="form-group">
                    <label for="search">Amount Paid</label><br>
                        <input type="number" class="form-control"  name="t_amount" placeholder="Enter Amount Paid" required>
                </div>

                <div class="form-group">
                    <label for="search">Date of Payment</label><br>
                        <input type="date" class="form-control"  name="t_date" placeholder="Date of Payment"  required>
                </div>
                <div class="form-group">
					
                   
                    <center><input type="submit" name="allocatebtn" value="Update Payment" class="btn btn-primary"></center>
			
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>