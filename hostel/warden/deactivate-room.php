<?php 
    session_start();
    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("01-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
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
$hostel=$result['hostelno'];

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
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <div class="cp">
            <form action="" method="post">
                <?php 
                   
                     if(isset($_POST['allocatebtn']))
                    {   

                        $roll=$_POST['rollno-select'];
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;
                       
                            
                   
                        
                           
                            $updateResult = $document->updateOne(
                                ['roll_no' => $roll],
                                ['$set' => [
                                    'hosteller'=>-1,
                                    'hostelno'.$semyear=>"",
                                    'floorno'.$semyear=>"",
                                    "room_no".$semyear=>"",
                                    "semyear"=>"",
                                    "deactive"=>1]]);
                      
                  
                        echo "<div class='alert alert-success index-alert-upd' role='alert'>
                        The student".$roll."  has been successfully deactivated from <br>".$hostel."</div>";
                       
                    }
                   

                ?>
                    <p>Do you want to Deactivate a particular student in <?php echo $hostel ?> ?</p>
                    <p>Later the students can reallocated through allocation module</p>
                    
                    <label for="image_side">Select Registration Number</label>
                    
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                    <option value="" hidden></option>
                    <?php 
                        
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;

                        $allStudents = $document->find([
                            'course' =>  $_SESSION['course'],
                            'dept' =>  $_SESSION['dept'], 
                            'hosteller' => 1
                           ]);
                        foreach ($allStudents as $as) {


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


                            if($stuyear==$_SESSION['year'] && ($as['role'] == 'Student'  || $as['role'] == 'hr' || $as['role'] == 'mr'))
                            {
                                echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    
                    <input type="submit" name="allocatebtn" class="btn btn-primary cancelbtn" value="De-Allocate Rooms">
                    </div>
            </form>
        </div>
    </div>
</body>
</html>