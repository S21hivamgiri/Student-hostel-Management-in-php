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
        
                    
                    if(isset($_POST['allocatebtn']))
                    { 
                        if($result)
                        {
                        $roll=$_POST['rollno-select'];
                        $insertResult = $document->updateOne(
                            ['roll_no' => $_POST['rollno-select']],
                             [ '$set'=>['stuyear' =>$_POST['year-select']]
                             ]);
                
                        echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The student ". $roll. " sucessfully updated with semester".$_SESSION['year']." to ".$_POST['year-select']." Semester.
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
                        'hosteller'=>1
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
                                             
                            if(($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr') &&   $stuyear==$_SESSION['year'] )
                            {
                                echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <br>
                </div>
				
				  <div class="form-group">
                    <label for="search">Enter the year of Student</label><br>
                        <select name="year-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        <option value="1st">1</option>
                        <option value="2nd">2</option>
                        <option value="3rd">3</option>
                        <option value="4th">4</option>
                        <option value="5th">5</option>
                        <option value="6th">6</option>
                        <option value="7th">7</option>
                        <option value="8th">8</option>
                    </select> 
                      </div>
                
             
                
                <div class="form-group">
					
                   
                    <center><input type="submit" name="allocatebtn" value="Update Sem" class="btn btn-primary"></center>
			</div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>