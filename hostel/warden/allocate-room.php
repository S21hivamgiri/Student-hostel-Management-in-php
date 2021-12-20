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
    
    $host=$result['hostelno'];
    $document = $collection->academics;

 $c= $document->findOne(['role'=>'hostel' ,'hostel'=>$host]);
 $_SESSION['ccode']=$c['hostel-for'];


    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("10-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
    
    function send_mail($email,$body,$body1,$subject)
    {
        require '../vendor/autoload.php';
        require_once('../PHPMailer-master/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isSMTP();                                     
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nitpyhostel@gmail.com';   
        $mail->Password = 'hostel@nitpy1';  
        $mail->SMTPSecure = 'tls';
        $mail->Port =587;    
        $mail->From='nitpyhostel@gmail.com';                     
        $mail->FromName = "Hostel NITPy";
        $mail->addAddress($email);                 
        $mail->WordWrap = 50;                               
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->IsHTML(true);
        $mail->AltBody  =  $body1;
        $mail->AddEmbeddedImage('../assets/img/Capture.png','my-attach', 'logo.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->AddEmbeddedImage('../assets/img/Capture-header.png','my-footer', 'footer.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
       
        // $mail->SMTPDebug = 2;
        if(!$mail->send()) {
            echo 'Email could not be sent.';
        
        } 
        else {
            echo 'A mail has been sent for notify the hosteller about the allocation';
        }
    }





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
                    
                    $client = (new MongoDB\Client);
                    $collection = $client->hostel;
                    $document = $collection->users;
                    
                    if(isset($_POST['dltbtn']))
                    {
                        $roll=$_SESSION['ditto'];
                        $updateResult = $document->updateOne(
                            ['roll_no' => $roll],
                            ['$set' => [
                                'hosteller'=>-2 ]]);

                    }
                    if(isset($_POST['passedbtn']))
                    {
                        $roll=$_SESSION['ditto'];
                        $updateResult = $document->updateOne(
                            ['roll_no' => $roll],
                            ['$set' => [
                                'hosteller'=>1 ]]);

                    }
                    if(isset($_POST['allocatebtn']))
                    {

                        
                        if($_POST['floor-select']=="")
                        { echo "Floor not Selected";}
                            else{
                                

                                if($_POST['roomNo']=="")
                                { echo "Room not Entered";}
                                    else{

                                        
                                if($_POST['hostel-select']=="")
                                { echo "Hostel not Selected";}
                                    else{

                        
                        $result = $document->findOne(['roll_no' => $_SESSION['ditto']]);
                        
                        $t =strtotime($result['doj']);
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
if($result['stuyear'])
{
    if($result['deactive']!=1)
$i=(int) substr($result['stuyear'],0,1)+1;
else $i=(int) substr($result['stuyear'],0,1);
if (($i %100) >= 11 && ($i%100) <= 13)
   $abbreviation = 'th';
else
   $abbreviation = $ends[$i % 10];
  $stuyear=$i.$abbreviation;

}
                        
                        if($_POST['floor-select']=='G')$floor="Ground";
                        else if($_POST['floor-select']=='F')$floor="First";
                        else if($_POST['floor-select']=='S')$floor="Second";
                        else if($_POST['floor-select']=='T')$floor="Third";
                        else if($_POST['floor-select']=='R')$floor="Fourth";
                        if($_POST['floor-select']=='G' && $_POST['roomNo']>39)
                        {
                            echo "In Ground floor Room Ranges from G1 to G39";
                        }
                        else{
                       
                        $room= $_POST['floor-select'].$_POST['roomNo'];
                        $name=$result['name'];
                        
                        $document = $collection->room;
                        $findResult = $document->findOne(
                            ['room_no' =>$room,
                            'hostelno' => $_POST['hostel-select']]);
                        
                        if($findResult['status']==1)
                        {
                            $actual_link = "http://$_SERVER[HTTP_HOST]/hostel/index.php";
                            $body="<img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
                            <div style='background-color=#fffadb;'><span style='margin-left: 15px;'><br>Dear ".$name.",
                            <br><p><span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!<br>
                            <span style='margin-left: 15px;'>This mail is sent to acknowledge you, that You are alloted to NITPy hostel @<b>".$room."</b> in <b>".$_POST['hostel-select']."</b> <br><br>
                            <span style='margin-left: 15px;'>You can login and enjoy full functioning of NITPy Online Hostel Management by clicking
                            <a href='".$actual_link."'>here.</a><br><br>              
                           <center> <br/> Do visit our institute website <a href='http://www.nitpy.ac.in'>http://www.nitpy.ac.in</a> for more information.
                            Mail : <a href='mailto:nitpyhostel@gmail.com'>nitpyhostel@gmail.com</a><br>                          
                            We hope to serve you in the best way and provide you with a great learning experience.
                            <br><br>
                            Regards,<br>
                            Hostel Management System.
                            <br>
                            <br></center>
                            <img  alt='footer' src='cid:my-footer' style='width: 100%;  height: auto;'>
                            ";
                            $body1="<img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
                            <div style='background-color=#fffadb;'><span style='margin-left: 15px;'><br>Dear ".$name.",
                            <p><br><span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!<br>
                            <span style='margin-left: 15px;'>This mail is sent to acknowledge you, that You are alloted to NITPy hostel @<b>".$room."</b> in <b>".$_POST['hostel-select']."</b> <br><br>
                            <span style='margin-left: 15px;'>You can login and enjoy full functioning of NITPy Online Hostel Management by clicking
                            <a href='".$actual_link."'>here.</a><br><br>              
                           <center> <br/> Do visit our institute website <a href='http://www.nitpy.ac.in'>http://www.nitpy.ac.in</a> for more information.
                            Mail : <a href='mailto:nitpyhostel@gmail.com'>nitpyhostel@gmail.com</a><br>                          
                            We hope to serve you in the best way and provide you with a great learning experience.
                            <br><br>
                            Regards,<br>
                            Hostel Management System.
                            <br>
                            <br></center>
                            <img  alt='footer' src='cid:my-footer' style='width: 100%;  height: auto;'>
                            ";
                            $subject="Regd. Room Allocation";
                        $document = $collection->users;
                        send_mail($result['p_email'],$body,$body1, $subject);
                        $updateResult = $document->updateOne(
                            ['roll_no' => $_SESSION['ditto']],
                            ['$set' => [
                                'room_no'.$semyear =>$room,
                                'floorno'.$semyear => $floor,
                                'hostelno'.$semyear => $_POST['hostel-select'],
                                'semyear'=>$semyear,
                                'hosteller'=>1,
                                'deactive'=>'',
                                'doa'=>$cur_date=date("d-m-Y"),
                                'stuyear'=>$stuyear
                            ]]
                        );
                        echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The student ". $_SESSION['ditto']. " has been successfully allocated to ".$room." in".$_POST['hostel-select'].".
                            </div>";
                        
                    }
                    else if($findResult['status']==-2)
                        {
                            echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                                The room no". $room. "  in".$_POST['hostel-select']." is under maintainance and cannot be allocated
                            </div>";
                        }
                        else if($findResult['status']==-2)
                        {
                            echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                            The room no". $room. "  in".$_POST['hostel-select']." is unallocatable and hence cannot be allocated
                        </div>";

                        }
                        
                }
                }
            }
        }
        }
                ?>
<label>Year: </label><?php echo " ".$semyear?><br>
               
<div class="form-group">
                    <label for="image_side">Select Registration Number</label>
            
                    <select name="rollno-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                    <option value="" hidden></option>
                    <?php 
                        
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;

                        $allStudents = $document->find([ 'gender'=> $_SESSION['ccode'], 'dept'=>$_SESSION['dept']  ,'course'=>$_SESSION['course']]);

                        foreach ($allStudents as $as) 
                    {
                            if(($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'||$as['role'] == 'student-council')  )
                            {
                            echo "<option value='".$as['roll_no']."'>".$as['roll_no']."</option>";
							}
                    }
                    ?>
                    </select>
                    <center><input type="submit" value="view Profile" name="viewprof" class="btn btn-primary"></center>
				
                    <br>
                </div>
             </form>   



<?php
            if(isset($_POST['viewprof']))
              {


                $document = $collection->users;
                $af=$document->findOne(['roll_no'=>$_POST['rollno-select'], 'course'=>$_SESSION['course'],'dept'=>$_SESSION['dept']]);
                $_SESSION['ditto']=$af["roll_no"];
                $file_name = $af['proofname'];
                if($file_name == ''){
                $file_name = 'default.png';
                }
                $file_pic = $af['filename'];
                
                // if($af['room_no'.$semyear]=='')$roomalloc= "Room Number Not Allocated"; else{ $roomalloc=$af['room_no'.$semyear];}
                
                // $_SESSION['rollno']=$_POST['rollno-select'];
                // if($af['floorno'.$semyear]=='')$flooralloc= "Room Number Not Allocated"; else $flooralloc= $af['floorno'.$semyear];
        
                // if($af['hostelno'.$semyear]=='')$hostelalloc= "Hostel Not Allocated"; else $hostelalloc= $af['hostelno'.$semyear];
                             echo ' 
                            <div class="view_profile">
                            <div class="section" id="personal">
                            <br>
                                <div class="section_title">
                                    <h1>Personal Information</h1>
                                </div>
                                <img src="../assets/img/Students/'.$file_pic.'" height=200 width=150>
                                <img src="../assets/img/Students/'.$file_name.'" height=200 width=150>
                                
                                <br><br>
                                <div class="section_sub_title">
                                    <h1>General Information</h1>
                                </div>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Registration Number</td>
                                            <td>'.$af['roll_no'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Student Name</td>
                                            <td>'.$af['name'].'</td>
                                        </tr>
                                        <tr>
                                        <td>Course</td>
                                        <td>'.$af['course'].'</td>
                                    </tr>
                                    <tr>
                                    <td>Dept</td>
                                    <td>'.$af['dept'].'</td>
                                      </tr>
                                        <tr>
                                            <td>Date of Joining</td>
                                            <td>'.$af['doj'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>'.$af['gender'].'</td>
                                        </tr>
                                    
                                        
                                    </tbody>
                                </table>
                                
                                <div class="section_sub_title">
                                    <h1>Permanent Address</h1>
                                </div>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Street Name</td>
                                            <td>'.$af['p_street'].'</td>
                                        </tr>
                                      
                                        <tr>
                                            <td>City</td>
                                            <td>'.$af['p_city'].'</td>
                                        </tr>
                                        <tr>
                                        <td>Area</td>
                                        <td>'.$af['p_district'].'</td>
                                    </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>'.$af['p_state'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>'.$af['p_country'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Pincode</td>
                                            <td>'.$af['p_pincode'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number</td>
                                            <td>'.$af['p_mobile'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>'.$af['p_email'].'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                
               
             
                   <form action="" method="post">
                   <div class="form-group">
                        <label for="search">Enter Room Number</label><br>
                        <select name="floor-select" style=" border-radius:4px;" class="floor-select-st shift-up">
                        <option value="" hidden selected="selected"></option>
                        <option value="G">G</option>
                        <option value="F">F</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                        <option value="R">R</option>
                    </select>   
                    
                        <input type="number" class="form-control" min="1" max="43" name="roomNo" value="" placeholder="Enter Room Number">
                </div>
              
                <div class="form-group">
					<label for="search">Select Hostel</label>
                    <select name="hostel-select" style=" border-radius:4px;" class="floor-select-st shift-up">';
                      
 $document = $collection->academics;
  $find=$document->find(['role'=>'hostel']);  
    
    
        foreach($find as $as)
        {
        echo "<option value='".$as['hostel']."'>".$as['hostel']."</option>";
        }
    
                   echo' </select>
                    <center><input type="submit" name="allocatebtn" value="Verifies as Valid Hosteller and Allocate Room" class="btn btn-primary"></center>
                    <center><input type="submit" name="dltbtn" value="Mark as non- Hosteller" class="btn btn-primary"></center>
                    <center><input type="submit" name="passedbtn" value="Mark as Passed Out" class="btn btn-primary"></center>
				
                           </form>
        </div>';
        
              }?>
              <br>
              <br>
              <br>
              <br>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>