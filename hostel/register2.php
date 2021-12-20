<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);
    $yearfull= date("Y");
    function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }
    $code = getToken(6);
    function send_mail($email,$body,$body1,$subject)
    {
        require './vendor/autoload.php';
        require_once('PHPMailer-master/PHPMailerAutoload.php');
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
        $mail->IsHTML(true);
        
        $mail->AddEmbeddedImage('./assets/img/Capture.png','my-attach', 'logo.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->AddEmbeddedImage('./assets/img/Capture-header.png','my-footer', 'footer.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->WordWrap = 50;                               
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody  =  $body1;
        // $mail->SMTPDebug = 2;
        if(!$mail->send()) {
            echo 'Message could not be sent.';
        
        } else {
            echo 'Message has been sent';
        }
    }

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
$document = $collection->academics;

 $c= $document->findOne(['role'=>'course' ,'course'=>$_SESSION['course']]);
 $ccode=$c['course-code'];
 $d= $document->findOne(['role'=>'dept' ,'dept'=>$_SESSION['dept']]);
 $dcode=$d['dept-code'];
 $document = $collection->users;
    $year=date("y");
    $temp="TEMP".$dcode.$year.$ccode."1";
  
    

    if(array_key_exists("verify", $_POST))
    {
        if ($_POST['verify'] == '1') 
                                    {
    
  if(isset($_POST['subinfo']))
  {
    if(array_key_exists("generate-temp", $_POST))
    {
        if ($_POST['generate-temp'] == '1') 
                                    {

                                        $count = $document->count(['year' =>$yearfull ,'dept'=>$_SESSION['dept'],'course'=>$_SESSION['course']]);
                                        if($count==0)
                                        {
                                            $id = str_pad($count+1, 3, '0', STR_PAD_LEFT);
                                        $roll= $temp.$id;
                                            
                                        }
                                        else  
                                        if($count>0)
                                        {
                                            $id = str_pad($count+1, 3, '0', STR_PAD_LEFT);
                                            $roll= $temp.$id;
                                        }

                                    }
    }

   else if($_POST['rollno']!="")
    {$roll=$_POST['rollno'];
    }else {echo"Roll No. not typed/selected";
    $roll="";}
    if($roll)
    {
                $result = $document->findOne(['p_email' => $_POST['email']]);
                if($result)
                echo "Email already registered";
                    else{

                        $result = $document->findOne(['p_mobile' => $_POST['phoneno']]);
                        if($result)
                        echo "Phone no. already registered";
                            else{
                if($_POST['cpass']==$_POST['pass'])
                {   



                 

                            $country=$_POST['country'];
                        
                    
                $client = (new MongoDB\Client);
                $collection = $client->hostel;
                $document = $collection->users;




                $target_dir = "./assets/img/Students/";
                $file_name=$_FILES["fileToUpload"]["name"];
                $file_pic=$_FILES["fileToPic"]["name"];
                $tmp = explode('.', $_FILES["fileToUpload"]["name"]);
                $temp = explode('.', $_FILES["fileToPic"]["name"]);
                
                $file_extension = end($tmp);
                $filep_extension = end($temp);
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $targetp_file = $target_dir . basename($_FILES["fileToPic"]["name"]);
                $uploadOk = 1;
                $uploadpOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $imageFileTypep = strtolower(pathinfo($targetp_file,PATHINFO_EXTENSION));
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    $check1 = getimagesize($_FILES["fileToPic"]["tmp_name"]);
                    if($check !== false) {
                        // echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                        File is not an image.
                        </div>";
                        $uploadOk = 0;
                    }
                
                if($check1 !== false) {
                    $uploadpOk = 1;
                } else {
                    echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                    File is not an image.
                    </div>";
                    $uploadpOk = 0;
                }
            }
        

                if ($_FILES["fileToUpload"]["size"] > 1000000) {
                    echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                        Sorry, your id proof file is too large.
                        </div>";
                    $uploadOk = 0;
                }
                if ($_FILES["fileToPic"]["size"] > 1000000) {
                    echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                        Sorry, your photo file is too large.
                        </div>";
                    $uploadOk = 0;
                } 

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"&& $imageFileType != "pdf" ) {
                    echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                        For Proof uploading Sorry, only PDF,JPG, JPEG, PNG & GIF files are allowed.
                        </div>";
                    $uploadOk = 0;
                }
                if($imageFileTypep != "jpg" && $imageFileTypep != "png" && $imageFileTypep != "jpeg"
                && $imageFileTypep != "gif" ) {
                    echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                        Sorry, For Pic Uploading only PDF, JPG, JPEG, PNG & GIF files are allowed.
                        </div>";
                    $uploadpOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                                Sorry, your proof file was not uploaded.
                            </div>";
                } else  if ($uploadpOk == 0) {
                    echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                                Sorry, your photo file was not uploaded.
                            </div>";
                } else
                {
                    $_FILES["fileToUpload"]["name"]=$roll."proof.".$file_extension;
                    $_FILES["fileToPic"]["name"]=$roll.'.'.$filep_extension;
                    
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $targetp_file = $target_dir . basename($_FILES["fileToPic"]["name"]);
                   
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $_SESSION['proof']= "  <div class='alert alert-success index-alert-upd' role='alert'>
                            The file ". $file_name. " has been uploaded.
                        </div>";
                    
                        if (move_uploaded_file($_FILES["fileToPic"]["tmp_name"], $targetp_file)) {
                            $_SESSION['pic']= "  <div class='alert alert-success index-alert-upd' role='alert'>
                            The file ". $file_pic. " has been uploaded.
                        </div>";







                        $actual_link = "http://$_SERVER[HTTP_HOST]/hostel/"."activatemail.php?id=".$roll."&code=".$code;
                        $body="<img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
                                <br><div style='background-color=#a0c9ff;'><p><span style='margin-left: 15px;'>Dear  <b>".strtoupper($_POST['name'])."</b></span>,<br>
                                <span style='margin-left: 15px;'>Greetings from team NITPy Online Hostel manageemnt!!<br></span>
                                <span style='margin-left: 15px;'>Congrats. You have successfully registered for NIYPy Hotel.</span><br><br>
                                <center>Here is your 6-digit verification code:<br>
                                <h1>".$code."</h1><br>
                                Click on the below link to activate your account.<br>
                                <a href='".$actual_link."'> <button style='background-color: #0016aa;
                                border: none;
                                color: white;
                                padding: 15px 32px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                border-radius: 4px;'>Activate Account</button></a><br><br>
                                
                                We welcome you to NIT Puducherry Hostel, We aim for Digitalization and Innovation              
                                <br/> Do visit our institute website <a href='http://www.nitpy.ac.in'>http://www.nitpy.ac.in</a> for more information.
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
                        <br><div style='background-color=#a0c9ff;'><p><span style='margin-left: 15px;'>Dear  <b>".strtoupper($_POST['name'])."</b></span>,<br>
                        <span style='margin-left: 15px;'>Greetings from team NITPy Online Hostel manageemnt!!<br></span>
                        <span style='margin-left: 15px;'>Congrats. You have successfully registered for NIYPy Hotel.</span><br><br>
                        <center>Here is your 6-digit verification code:<br>
                        <h1>".$code."</h1><br>
                        Click on the below link to activate your account.<br>
                        <a href='".$actual_link."'> <button style='background-color: #0016aa;
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        border-radius: 4px;'>Activate Account</button></a><br><br>
                        
                        We welcome you to NIT Puducherry Hostel, We aim for Digitalization and Innovation              
                        <br/> Do visit our institute website <a href='http://www.nitpy.ac.in'>http://www.nitpy.ac.in</a> for more information.
                        Mail : <a href='mailto:nitpyhostel@gmail.com'>nitpyhostel@gmail.com</a><br>                          
                        We hope to serve you in the best way and provide you with a great learning experience.
                        <br><br>
                        Regards,<br>
                        Hostel Management System.
                        <br>
<br></center>
<img  alt='footer' src='cid:my-footer' style='width: 100%;  height: auto;'>
            
                        ";
                        $subject="Regd. Activation of Hostel Account in NITPy";


                        $email=$_POST['email'];
                        $_SESSION['username']=$roll;
                        $_SESSION['roll_no']=$roll;
                        $_SESSION['proofname'] = basename( $_FILES["fileToUpload"]["name"]);
                        $_SESSION['picname'] = basename( $_FILES["fileToPic"]["name"]);
                        send_mail($email,$body,$body1, $subject);
                        $insertdata=$document->insertOne([
                    'name' => strtoupper($_POST['name']),
                    'roll_no'=>strtoupper($roll),
                    'gender'=>$_POST['gender'],
                    'p_email'=> $_POST['email'],
                    'p_mobile'=> $_POST['phoneno'],
                    'e_phone'=>$_POST['ephoneno'],
                    'paid'=>0,
                    'b_date'=>$_POST['dob'],
                    'year'=>$yearfull,
                    'dept'=>$_SESSION['dept'],
                    'course'=>$_SESSION['course'],
                    'veg'=>$_POST['food'],
                    'f_name'=> $_POST['fname'],
                    'f_email'=>$_POST['femail'],
                    'f_number'=>$_POST['fphoneno'],
                    'veg'=>$_POST['food'],
                    'password'=>md5($_POST['pass']),
                    'p_pincode'=>$_POST['pincode'],
                    'p_state'=>$_POST['state'],
                    'p_district'=>$_POST['district'],
                    'p_city'=>$_POST['city'],
                    'p_country'=>$country,
                    'doj'=>$_POST['doj'],
                    'proofname'=>$_SESSION['proofname'],
                    'p_street'=>$_POST['street'],
                    'semyear'=>'',
                    'username'=>$roll,
                    'role'=>'Student',
                    'last_login'=>'',
                    'feed'=>0,
                    'otp'=>$code,
                    'deactive'=>'',
                    'hosteller'=>-2,
                    'stat'=>3,
                    'filename'=>    $_SESSION['picname']
                ]);
                header("location:usepass.php");
            } else {
                echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                    Sorry, there was an error uploading Profile Pic your file. Cannot save Update Your Information 
                </div>";
            }       
            } else {
                        echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                            Sorry, there was an error uploading Proof your file. Cannot save Update Your Information 
                        </div>";
                    }
                }
                }
            
            else echo "<div class='alert alert-danger index-alert-upd' role='alert'>Password did not match</div>";  
                }
            }
        }
    }
 }
                                
                                    else echo "<div class='alert alert-danger index-alert-upd' role='alert'>You must verify  declaration!!!</div>";   
                                
                                }
?>  
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
      <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
	</head>
	<body>
    <div class="centerstage row">
            <div class="container initiate-file">
                <div class="feedback">
        <form action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="section_title spread">
                                  <h1>General information</h1>
                            </div>
                            <br><br>
                        
                        
                            <div class="form-group">
                            <label>Enter Roll Number</label>
                            <input type="text" class="form-control spec-1" name="rollno" value="" placeholder="Enter Roll Number">
                            </div>
                            <div class="form-group">
            <label>Roll Number Not Assigned</label>
            <input type="checkbox" class="form-control spec-2" name="generate-temp" id="checkpost" value="1">
              
            </div>
            <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control spec-1" name="name" placeholder="Enter Name" required>
            </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <input type="radio" name="gender" value="male" class="login-fields-r spec-2" required><span class="radio">Male</span><br>
                    <input type="radio" name="gender" value="female" class="login-fields-r spec-2" required><span class="radio">Female</span> <br>
                </div>
				<div class="form-group">
                    <label>Food Specialization</label><br>
                    <input type="radio" name="food" value="vegetarian" class="login-fields-r spec-2" required><span class="radio">Vegetarian</span> <br>
                    <input type="radio" name="food" value="eggetarian" class="login-fields-r spec-2" required><span class="radio">Eggetarian</span> <br>
                    <input type="radio" name="food" value="non-vegetarian" class="login-fields-r spec-2" required><span class="radio">Non- Vegetarian</span> <br>
                    </div>
                    <div class="section_title spread">
                                  <h1>Contact  information</h1>
                            </div>
                            <br><br>
            
            <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control spec-1" name="email" placeholder="Enter Email" required>
                            </div>
                            
            <div class="form-group">
                            <label>Phone No</label>
                            <input type="number" class="form-control spec-1" name="phoneno" placeholder="Enter Phone No." required>
                            </div>
                            <div class="form-group">
                            <label>Emergency Phone No</label>
                            <input type="number" class="form-control spec-1" name="ephoneno" placeholder="Enter Emergency Phone No." required>
                            </div>
                            <div class="form-group">
                            <label>Enter Date of Birth</label>
                            <input type="date" class="form-control spec-1" name="dob"  required>
                            </div>
                            <div class="form-group">
                            <label>Enter Date of Joining this Institute</label>
                            <input type="number" class="form-control spec-1" name="doj" min="2012" max="2099" step="1" value="<?php echo $yearfull;?>" required>
                            </div>

            <div class="section_title spread">
                                  <h1>Parent's Information</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            <label>Father's Name</label>
                            <input type="text" class="form-control spec-1" name="fname" placeholder="Enter Father's Name" required>
                            </div>
              
                            <div class="form-group">
                            <label>Father's Email</label>
                            <input type="email" class="form-control spec-1" name="femail" placeholder="Enter Father's Email" required>
                            </div>
            <div class="form-group">
                            <label>Father's Phone No</label>
                            <input type="number" class="form-control spec-1" name="fphoneno" placeholder="Enter Father's Phone No." required>
                            </div>
                            
                 
                            <div class="section_title spread">
                                  <h1>Address of Communication/Permanent Address</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            <label>House Number & Street</label>
                            <input type="text" class="form-control spec-1" name="street" placeholder="Enter Housing Address Here" required>
                            </div>
                            <div class="form-group">
                            <label>Village/City</label>
                            <input type="text" class="form-control spec-1" name="city" placeholder="Enter City/Village Here" required>
                            </div>
                            <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control spec-1" name="district" placeholder="Enter District Here" required>
                            </div>
                            <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control spec-1" name="state" placeholder="Enter State Here(Don't Enter Abbrevation/hypen enter full name)" required>
                            </div>



                      <div class="form-group">
                            <label>Country</label>
                            
                            </div>
                       
                            <select name="country" style=" border-radius:4px;" class="floor-select-st shift-up">

    <option value='Ascension Island'>Ascension Island</option>
    <option value='Andorra'>Andorra</option>
    <option value='United Arab Emirates'>United Arab Emirates</option>
    <option value='Afghanistan'>Afghanistan</option>
    <option value='Antigua And Barbuda'>Antigua And Barbuda</option>
    <option value='Anguilla'>Anguilla</option>
    <option value='Albania'>Albania</option>
    <option value='Armenia'>Armenia</option>
    <option value='Angola'>Angola</option>
    <option value='Antarctica'>Antarctica</option>
    <option value='Argentina'>Argentina</option>
    <option value='American Samoa'>American Samoa</option>
    <option value='Austria'>Austria</option>
    <option value='Australia'>Australia</option>
    <option value='Aruba'>Aruba</option>
    <option value='Åland Islands'>Åland Islands</option>
    <option value='Azerbaijan'>Azerbaijan</option>
    <option value='Barbados'>Barbados</option>
    <option value='Bangladesh'>Bangladesh</option>
    <option value='Belgium'>Belgium</option>
    <option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>
    <option value='Burkina Faso'>Burkina Faso</option>
    <option value='Bulgaria'>Bulgaria</option>
    <option value='Bahrain'>Bahrain</option>
    <option value='Burundi'>Burundi</option>
    <option value='Benin'>Benin</option>
    <option value='Saint Barthélemy'>Saint Barthélemy</option>
    <option value='Bermuda'>Bermuda</option>
    <option value='Brunei Darussalam'>Brunei Darussalam</option>
    <option value='Bolivia, Plurinational State Of'>Bolivia, Plurinational State Of</option>
    <option value='Bonaire, Saint Eustatius And Saba'>Bonaire, Saint Eustatius And Saba</option>
    <option value='Brazil'>Brazil</option>
    <option value='Bahamas'>Bahamas</option>
    <option value='Bhutan'>Bhutan</option>
    <option value='Bouvet Island'>Bouvet Island</option>
    <option value='Botswana'>Botswana</option>
    <option value='Belarus'>Belarus</option>
    <option value='Belize'>Belize</option>
    <option value='Canada'>Canada</option>
    <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
    <option value='Democratic Republic Of Congo'>Democratic Republic Of Congo</option>
    <option value='Central African Republic'>Central African Republic</option>
    <option value='Republic Of Congo'>Republic Of Congo</option>
    <option value='Switzerland'>Switzerland</option>
    <option value="Cote d' Ivoire">Cote d'Ivoire</option>
    <option value='Cook Islands'>Cook Islands</option>
    <option value='Chile'>Chile</option>
    <option value='Cameroon'>Cameroon</option>
    <option value='China'>China</option>
    <option value='Colombia'>Colombia</option>
    <option value='Clipperton Island'>Clipperton Island</option>
    <option value='Costa Rica'>Costa Rica</option>
    <option value='Cuba'>Cuba</option>
    <option value='Cabo Verde'>Cabo Verde</option>
    <option value='Curacao'>Curacao</option>
    <option value='Christmas Island'>Christmas Island</option>
    <option value='Cyprus'>Cyprus</option>
    <option value='Czech Republic'>Czech Republic</option>
    <option value='Germany'>Germany</option>
    <option value='Diego Garcia'>Diego Garcia</option>
    <option value='Djibouti'>Djibouti</option>
    <option value='Denmark'>Denmark</option>
    <option value='Dominica'>Dominica</option>
    <option value='Dominican Republic'>Dominican Republic</option>
    <option value='Algeria'>Algeria</option>
    <option value='Ceuta, Mulilla'>Ceuta, Mulilla</option>
    <option value='Ecuador'>Ecuador</option>
    <option value='Estonia'>Estonia</option>
    <option value='Egypt'>Egypt</option>
    <option value='Western Sahara'>Western Sahara</option>
    <option value='Eritrea'>Eritrea</option>
    <option value='Spain'>Spain</option>
    <option value='Ethiopia'>Ethiopia</option>
    <option value='European Union'>European Union</option>
    <option value='Finland'>Finland</option>
    <option value='Fiji'>Fiji</option>
    <option value='Falkland Islands'>Falkland Islands</option>
    <option value='Micronesia, Federated States Of'>Micronesia, Federated States Of</option>
    <option value='Faroe Islands'>Faroe Islands</option>
    <option value='France'>France</option>
    <option value='France, Metropolitan'>France, Metropolitan</option>
    <option value='Gabon'>Gabon</option>
    <option value='United Kingdom'>United Kingdom</option>
    <option value='Grenada'>Grenada</option>
    <option value='Georgia'>Georgia</option>
    <option value='French Guiana'>French Guiana</option>
    <option value='Guernsey'>Guernsey</option>
    <option value='Ghana'>Ghana</option>
    <option value='Gibraltar'>Gibraltar</option>
    <option value='Greenland'>Greenland</option>
    <option value='Gambia'>Gambia</option>
    <option value='Guinea'>Guinea</option>
    <option value='Guadeloupe'>Guadeloupe</option>
    <option value='Equatorial Guinea'>Equatorial Guinea</option>
    <option value='Greece'>Greece</option>
    <option value='South Georgia And The South Sandwich Islands'>South Georgia And The South Sandwich Islands</option>
    <option value='Guatemala'>Guatemala</option>
    <option value='Guam'>Guam</option>
    <option value='Guinea-bissau'>Guinea-bissau</option>
    <option value='Guyana'>Guyana</option>
    <option value='Hong Kong'>Hong Kong</option>
    <option value='Heard Island And McDonald Islands'>Heard Island And McDonald Islands</option>
    <option value='Honduras'>Honduras</option>
    <option value='Croatia'>Croatia</option>
    <option value='Haiti'>Haiti</option>
    <option value='Hungary'>Hungary</option>
    <option value='Canary Islands'>Canary Islands</option>
    <option value='Indonesia'>Indonesia</option>
    <option value='Ireland'>Ireland</option>
    <option value='Israel'>Israel</option>
    <option value='Isle Of Man'>Isle Of Man</option>
    <option value='India' selected>India</option>
    <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
    <option value='Iraq'>Iraq</option>
    <option value='Iran, Islamic Republic Of'>Iran, Islamic Republic Of</option>
    <option value='Iceland'>Iceland</option>
    <option value='Italy'>Italy</option>
    <option value='Jersey'>Jersey</option>
    <option value='Jamaica'>Jamaica</option>
    <option value='Jordan'>Jordan</option>
    <option value='Japan'>Japan</option>
    <option value='Kenya'>Kenya</option>
    <option value='Kyrgyzstan'>Kyrgyzstan</option>
    <option value='Cambodia'>Cambodia</option>
    <option value='Kiribati'>Kiribati</option>
    <option value='Comoros'>Comoros</option>
    <option value='Saint Kitts And Nevis'>Saint Kitts And Nevis</option>
    <option value="Korea, Democratic People's Republic Of">Korea, Democratic People's Republic Of</option>
    <option value='Korea, Republic Of'>Korea, Republic Of</option>
    <option value='Kuwait'>Kuwait</option>
    <option value='Cayman Islands'>Cayman Islands</option>
    <option value='Kazakhstan'>Kazakhstan</option>
    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
    <option value='Lebanon'>Lebanon</option>
    <option value='Saint Lucia'>Saint Lucia</option>
    <option value='Liechtenstein'>Liechtenstein</option>
    <option value='Sri Lanka'>Sri Lanka</option>
    <option value='Liberia'>Liberia</option>
    <option value='Lesotho'>Lesotho</option>
    <option value='Lithuania'>Lithuania</option>
    <option value='Luxembourg'>Luxembourg</option>
    <option value='Latvia'>Latvia</option>
    <option value='Libya'>Libya</option>
    <option value='Morocco'>Morocco</option>
    <option value='Monaco'>Monaco</option>
    <option value='Moldova'>Moldova</option>
    <option value='Montenegro'>Montenegro</option>
    <option value='Saint Martin'>Saint Martin</option>
    <option value='Madagascar'>Madagascar</option>
    <option value='Marshall Islands'>Marshall Islands</option>
    <option value='Macedonia, The Former Yugoslav Republic Of'>Macedonia, The Former Yugoslav Republic Of</option>
    <option value='Mali'>Mali</option>
    <option value='Myanmar'>Myanmar</option>
    <option value='Mongolia'>Mongolia</option>
    <option value='Macao'>Macao</option>
    <option value='Northern Mariana Islands'>Northern Mariana Islands</option>
    <option value='Martinique'>Martinique</option>
    <option value='Mauritania'>Mauritania</option>
    <option value='Montserrat'>Montserrat</option>
    <option value='Malta'>Malta</option>
    <option value='Mauritius'>Mauritius</option>
    <option value='Maldives'>Maldives</option>
    <option value='Malawi'>Malawi</option>
    <option value='Mexico'>Mexico</option>
    <option value='Malaysia'>Malaysia</option>
    <option value='Mozambique'>Mozambique</option>
    <option value='Namibia'>Namibia</option>
    <option value='New Caledonia'>New Caledonia</option>
    <option value='Niger'>Niger</option>
    <option value='Norfolk Island'>Norfolk Island</option>
    <option value='Nigeria'>Nigeria</option>
    <option value='Nicaragua'>Nicaragua</option>
    <option value='Netherlands'>Netherlands</option>
    <option value='Norway'>Norway</option>
    <option value='Nepal'>Nepal</option>
    <option value='Nauru'>Nauru</option>
    <option value='Niue'>Niue</option>
    <option value='New Zealand'>New Zealand</option>
    <option value='Oman'>Oman</option>
    <option value='Panama'>Panama</option>
    <option value='Peru'>Peru</option>
    <option value='French Polynesia'>French Polynesia</option>
    <option value='Papua New Guinea'>Papua New Guinea</option>
    <option value='Philippines'>Philippines</option>
    <option value='Pakistan'>Pakistan</option>
    <option value='Poland'>Poland</option>
    <option value='Saint Pierre And Miquelon'>Saint Pierre And Miquelon</option>
    <option value='Pitcairn'>Pitcairn</option>
    <option value='Puerto Rico'>Puerto Rico</option>
    <option value='Palestinian Territory, Occupied'>Palestinian Territory, Occupied</option>
    <option value='Portugal'>Portugal</option>
    <option value='Palau'>Palau</option>
    <option value='Paraguay'>Paraguay</option>
    <option value='Qatar'>Qatar</option>
    <option value='Reunion'>Reunion</option>
    <option value='Romania'>Romania</option>
    <option value='Serbia'>Serbia</option>
    <option value='Russian Federation'>Russian Federation</option>
    <option value='Rwanda'>Rwanda</option>
    <option value='Saudi Arabia'>Saudi Arabia</option>
    <option value='Solomon Islands'>Solomon Islands</option>
    <option value='Seychelles'>Seychelles</option>
    <option value='Sudan'>Sudan</option>
    <option value='Sweden'>Sweden</option>
    <option value='Singapore'>Singapore</option>
    <option value='Saint Helena, Ascension And Tristan Da Cunha'>Saint Helena, Ascension And Tristan Da Cunha</option>
    <option value='Slovenia'>Slovenia</option>
    <option value='Svalbard And Jan Mayen'>Svalbard And Jan Mayen</option>
    <option value='Slovakia'>Slovakia</option>
    <option value='Sierra Leone'>Sierra Leone</option>
    <option value='San Marino'>San Marino</option>
    <option value='Senegal'>Senegal</option>
    <option value='Somalia'>Somalia</option>
    <option value='Suriname'>Suriname</option>
    <option value='South Sudan'>South Sudan</option>
    <option value='São Tomé and Príncipe'>São Tomé and Príncipe</option>
    <option value='USSR'>USSR</option>
    <option value='El Salvador'>El Salvador</option>
    <option value='Sint Maarten'>Sint Maarten</option>
    <option value='Syrian Arab Republic'>Syrian Arab Republic</option>
    <option value='Swaziland'>Swaziland</option>
    <option value='Tristan de Cunha'>Tristan de Cunha</option>
    <option value='Turks And Caicos Islands'>Turks And Caicos Islands</option>
    <option value='Chad'>Chad</option>
    <option value='French Southern Territories'>French Southern Territories</option>
    <option value='Togo'>Togo</option>
    <option value='Thailand'>Thailand</option>
    <option value='Tajikistan'>Tajikistan</option>
    <option value='Tokelau'>Tokelau</option>
    <option value='Timor-Leste, Democratic Republic of'>Timor-Leste, Democratic Republic of</option>
    <option value='Turkmenistan'>Turkmenistan</option>
    <option value='Tunisia'>Tunisia</option>
    <option value='Tonga'>Tonga</option>
    <option value='Turkey'>Turkey</option>
    <option value='Trinidad And Tobago'>Trinidad And Tobago</option>
    <option value='Tuvalu'>Tuvalu</option>
    <option value='Taiwan'>Taiwan</option>
    <option value='Tanzania, United Republic Of'>Tanzania, United Republic Of</option>
    <option value='Ukraine'>Ukraine</option>
    <option value='Uganda'>Uganda</option>
    <option value='United Kingdom'>United Kingdom</option>
    <option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
    <option value='United States'>United States</option>
    <option value='Uruguay'>Uruguay</option>
    <option value='Uzbekistan'>Uzbekistan</option>
    <option value='Vatican City State'>Vatican City State</option>
    <option value='Saint Vincent And The Grenadines'>Saint Vincent And The Grenadines</option>
    <option value='Venezuela, Bolivarian Republic Of'>Venezuela, Bolivarian Republic Of</option>
    <option value='Virgin Islands (British)'>Virgin Islands (British)</option>
    <option value='Virgin Islands (US)'>Virgin Islands (US)</option>
    <option value='Vietnam'>Vietnam</option>
    <option value='Vanuatu'>Vanuatu</option>
    <option value='Wallis And Futuna'>Wallis And Futuna</option>
    <option value='Samoa'>Samoa</option>
    <option value='Yemen'>Yemen</option>
    <option value='Mayotte'>Mayotte</option>
    <option value='South Africa'>South Africa</option>
    <option value='Zambia'>Zambia</option>
    <option value='Zimbabwe'>Zimbabwe</option>    
</select>

                 
                    <div class="form-group">
                            <label>Pincode</label>
                            <input type="number" class="form-control spec-1" name="pincode" placeholder="Enter Pin Code">
                            </div>
                        
            <div class="section_title spread">
                                  <h1>Password Section</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            <label>Enter Password</label>
                            <input type="password" class="form-control spec-1" name="pass" placeholder="Enter Password" required>
                            </div>
              
                            <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control spec-1" name="cpass" placeholder="Confirm Password" required>
                            </div>


                          
                   Upload a Identity proof driving licence/ Adhaar card/Passport or 10/12th certificate:
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control spec-1">
                <br><br>
                Upload a Photograph:
                <input type="file" name="fileToPic" id="fileToPic" class="form-control spec-1">
                <br><br>
<script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
         ...
      });
  });
  </script>
            <div class="form-group">
            
            <input type="checkbox" class="form-control spec-2" name="verify" id="checkpost" value="1">
            <label class="inline">I hereby declare that above Information are best of my knowledge and Wrong Information can cause severe action and even results to non- allocation in the hostel</label>  
            </div>
            <div class="center-align">
                <input type="submit" name="subinfo" value="Submit Info" class="btn btn-primary img-ctn-btn">
            </div>
                    
           </form>
           </div>   
           </div>
        </div>
           
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>