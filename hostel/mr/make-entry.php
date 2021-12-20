<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    date_default_timezone_set("Asia/Kolkata");
    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");

     $result = $document->findOne(['username' => $_SESSION['username'], 'password' =>($_SESSION['password'])]);
    if(!$result){
        header("location:../index.php");
    }
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
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="make-entry-div">
        <form action="" method="post">
            <?php 
            $sr = strtoupper($result['roll_no']);
                   
                if(isset($_POST['make-entry']))
                {
                     $document = $collection->register;
                 $iy = $document->count([
                            "role" => 'In/Out']);$i=$iy+1;
                  
                  
                    
                    $zid="IO".$i;
                    $document = $collection->users;
                    $af = $document->findOne(['roll_no' => $sr]); 
                    $sp = $af['p_mobile'];
                    $sn = $af['name'];      
                    $srn = $af['room_no'.$semyear]; 
                    $shst = $af['hostelno'.$semyear]; 
                    $od = $_POST['out-date'];
                    
                    $reason=$_POST['student-reason'];
                      if($af['stuyear']) $stuyear=$af['stuyear'];
                            else{
                            $t =strtotime($f['doj']);
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
                  
                    $document = $collection->register;
                    $insertStmt = $document->insertOne([
                            'id'=>$zid,
                            'student_name' => $sn, 
                            'student_roll_number' => $sr,
                            'student_number' => $sp,
                            'student_room_no' => $srn,
                            'out_time' => '',
                            'exp_out_time'=>$_POST['out-time'],
                            'out_date' => $od,
                            'in_time' => '',
                            'in_date' => $od,
                            'room' => $srn, 
                            "role" => 'In/Out',
                             "hostel" => $shst,
                            'reason'=>$reason,
                            'journey'=>'',
                            'sem'=>$stuyear
                           
                        ]);
                    echo '<div class="alert alert-success index-alert" role="alert">
                        New Entry Added!
                      </div>';
                }
            ?>
            <div class="img-ctn-h1">
                <h1>Make Entry</h1>
            </div>
            <br>
            <div class="form-group">
          
                <br><label style="font-weight:bold;">Roll Number: <?php echo $sr;?></label>
                 </div>
            <div class="form-group">
                <label for="student-roll-number">Enter Place and Reason of Visit</label>
                <input type="text" class="form-control" name="student-reason" placeholder="Enter Reason of Visit" required>                
            </div>
            <div class="form-group">
                <label for="out-time">Enter Out Date</label>
                <input type="date" class="form-control out-field" name="out-date" placeholder="Enter Out Date" required value="<?php echo date("Y-m-d");?>">                
            </div> 
            <div class="form-group">
                <label for="out-time">Enter Expected Out Time</label>
                <input type="time" class="form-control out-field" name="out-time" placeholder="Enter Out Time" required value="<?php echo date("H:m")?>">                
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="make-entry" value="Submit">
        </form>
    </div> 
</body>

</html>