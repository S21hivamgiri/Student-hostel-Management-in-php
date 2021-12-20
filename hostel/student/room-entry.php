<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    date_default_timezone_set("Asia/Kolkata");
      $result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])]);
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
                $room_select = htmlspecialchars($_GET["room_select"]);
               


                if(isset($_POST['make-entry']))
                {
                     $document = $collection->register;
                 $iy = $document->count([
                            "role" => $room_select]);$i=$iy+1;
                        
                if($room_select==="HealthCare Room")$zid="HR".$i;
                
                if($room_select==="Common Room")$zid="CR".$i;
                 if($room_select==="Gym Room")$zid="GR".$i;
                
                    $sn = $result['name'];
                    $sr = $result['roll_no'];
                    $ot = $_POST['out-time'];
                    $rs = $_POST['room_select'];
                    $document = $collection->users;
                    $af = $document->findOne(['roll_no' => $sr]); 
                    $sp = $af['p_mobile'];                   
                    $srn = $af['room_no'.$semyear];
                    $srh = $af['hostelno'.$semyear];  
                    $od = date("l d-m-Y");
                    $it = "";
                    $id = "";     
                    $document = $collection->register;
                    $insertStmt = $document->insertOne([
                              'id' => $zid,
                            'student_name' => $sn, 
                            'student_roll_number' => $sr,
                            'student_number' => $sp,
                            'student_room_no' => $srn,
                            'out_time' => "",
                            'exp_in_time' => $ot,
                            'in_date' => $od,
                            'in_time' => "",
                            'out_date' => $od,
                            'room' => $rs,
                            'hostel'=> $srh,
                            "role" => $room_select,
                            "dor"=>$od
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
                <label for="student-name"> Name:</label>
                <?php echo $result['name'];?>
                 </div>
            <div class="form-group">
                <label for="student-roll-number">Enter Roll Number</label>
                <?php echo $result['roll_no'];?>
                </div>
            <div class="form-group">
                <label for="out-time">Enter In Time</label>
                <input type="text" class="form-control out-field" name="out-time" placeholder="Enter In Time" required value="">                
            </div>
            <div class="form-group">
                <label for="room_select">Room Selected</label>
                <input type="text" name="room_select" class="form-control" value="<?php echo $room_select; ?>" readonly>
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="make-entry" value="Submit">
        </form>
    </div> 
</body>
<script>
    $('.out-field').click(function(){
        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
        var time = formatAMPM(new Date);
        $('.out-field').val(time);
    });
</script>
</html>