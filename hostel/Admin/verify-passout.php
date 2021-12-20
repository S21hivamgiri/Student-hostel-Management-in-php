    <?php
    session_start();
    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("10-06-".$year))

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

    $host=$result['hostelno'];

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
    
    <div class="img-ctn-h1 spread">
        <h1>Verify the passouts</h1>
    </div>    
    <br>
    <div class="border">
      <form action="" method="post">
        <input type="checkbox" name="formDoor[]" value="none" class='spec-2' /> 
        <label for="formdoor">All the student are Ready to Leave the hostel</label>  
        <p class="center-align">Or</p>
        <label for="">Select the student still to be staying in Hostel?</label>
        <br />  

      <?php 
        $document = $collection->academics;


         $find=$document->findOne(['role'=>'course', 'course'=>$_SESSION['course']]);  
           $ends = array('th','st','nd','rd','th','th','th','th','th','th');

           $i=(int)$find['duration'];
if (($i %100) >= 11 && ($i%100) <= 13)
   $abbreviation = 'th';
else 
   $abbreviation = $ends[$i % 10];
$year=$find['duration'].$abbreviation;
        $document = $collection->users;

        $result = $document->find(['hostelno'.$semyear=>$host, 'course'=>$_SESSION['course'],'dept'=>$_SESSION['dept'],'stuyear'=>$year]);
        $cur_date=date("d-m-Y");
      
        $count=0;
        $rollcount=array();
        foreach($result as $af)
        {
            $t =strtotime("10/06/".$af['doj']);
            $end = strtotime('+'.$find['duration'].' years', $t);
            
            if($end<strtotime($cur_date)&& ($af['hosteller']==1||$af['hosteller']==-1))
            {
              echo '<input type="checkbox" name="formDoor[]" value="'.$af["roll_no"].'" /> '.$af["name"].'('.$af["roll_no"].')<hr>';
              $rollcount[$count]=$af["roll_no"];
             
            }
        }
        echo'<br><br><input type="submit" name="formSubmit" class="btn btn-primary img-ctn-btn" value="Submit" />
            <br>';
        echo"</form>";

         $mutex=1;
        if(isset($_POST['formSubmit']))
        {
          foreach($_POST['formDoor'] as $chkval)
            if($chkval == "none")
               { $mutex=0;}
          $roll = $_POST['formDoor'];
          if(empty($roll))
            echo("Must Select a Value");
          
        
        else if($mutex==0)
        {
           $count=sizeof($rollcount);
          echo "All the student in ".$_SESSION['dept']." of ".$_SESSION['course']." are successfully passed and moved out of hostel";

                  for($i=0; $i < $count; $i++)
                  {
                      $result = $document->updateOne(['roll_no'=>$rollcount[$i]],
                      ['$set' => ['hosteller' => -3]]);
                  }
        }
 
        else
        {
          $N = count($roll);
          for($i=0; $i < $count; $i++)
          {
            $result = $document->updateOne(['role' => 'Student','hosteller'=>1,'roll_no'=>$rollcount[$i],'hostelno'.$semyear=>$host],
            ['$set' => ['hosteller' => 0]]);
          }
          echo("You selected ".$N." student(s) still to remain further in hostel: ");
          for($i=0; $i < $N; $i++)
          {
            echo($roll[$i] . " ");
            $result = $document->updateOne(['role' => 'Student','hosteller'=>0,'roll_no'=>$roll[$i],'hostelno'.$semyear=>$host ],
            ['$set' => ['hosteller' => 1]]);
          }
        }
      } 
      ?>
    </div>


</body>
