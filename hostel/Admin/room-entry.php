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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">

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
                        
                if($room_select==="Visitor Room")$zid="VR".$i; 
                
                    $sn = ucfirst($_POST['visitor-name']);
                    $sr = strtoupper($_POST['visitor-phone-number']);
                    
                    $document = $collection->users;
                    $sp = $result['p_mobile'];  
                    $wid=  $result['wdn_id'];
                    $name=$result['name'];
                    $reg_time = date("l d-m-Y");
                    $ot = "";
                    $od = "";     
                    $document = $collection->register;
                    $insertStmt = $document->insertOne([
                            'id' => $zid,
                            'vis_name' => $sn, 
                            'vis_number' => $sr,
                            'wdn_number' => $sp,
                            'out_time' => $ot,
                            'out_date' => $od,
                            'in_time' => "",
                            'in_date' => $_POST['in-date'],
                            'app_in_time'=>$_POST['in-time'],
                            'room' => $room_select,
                            'wdn_id'=>$wid,
                             'name'=>$name,
                            "role" => $room_select
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
            <?php
            echo "<p style='font-weight:bold'>".$result['wdn_id']."<br><br>".$result['name']."</p>";
            ?><div class="form-group">
                <label for="student-name">Enter Name of Visitor</label>
                <input type="text" class="form-control" name="visitor-name" placeholder="Enter Visitor Name" required>
            </div>
            <div class="form-group">
                <label for="student-roll-number">Enter Phone No.</label>
                <input type="number" class="form-control" name="visitor-phone-number" placeholder="Enter Visitor phone Number" required>                
            </div>
            <div class="form-group">
                <label for="out-date">Enter Date of Visiting</label>
                <input type="date" class="form-control out-field" name="in-date" placeholder="Enter In Date" required value="">                
            </div>
            <div class="form-group">
                <label for="out-time">Enter Approx In Time</label>
                <input type="time" class="form-control out-field" name="in-time" placeholder="Enter In Time" required value="">                
            </div>
             
            <div class="form-group">
                <label for="room_select">Room Selected</label>
                <input type="text" name="room_select" class="form-control" value="<?php echo $room_select; ?>" readonly>
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="make-entry" value="Submit"><br><br><br><br>
        </form>
    </div> 
</body>
</html>