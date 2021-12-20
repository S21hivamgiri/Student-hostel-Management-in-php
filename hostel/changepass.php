<?php
  session_start();
  require_once "./vendor/autoload.php";
  date_default_timezone_set("Asia/Kolkata");
  //error_reporting(0);
  $client = (new MongoDB\Client);
  $collection = $client->hostel;
  $document = $collection->users;
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
        $mail->WordWrap = 50;                               
        $mail->Subject = $subject;
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage('./assets/img/Capture.png','my-attach', 'logo.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->AddEmbeddedImage('./assets/img/Capture-header.png','my-footer', 'footer.png', 'base64', 'image/png'); // attach file logo.jpg, and later link to it using identfier logoimg
        $mail->Body    = $body;

        $mail->AltBody  =  $body1;
        
        // $mail->SMTPDebug = 2;
        if(!$mail->send()) {
            echo 'Message could not be sent.';
        
        } 
        else {
            echo 'A mail has been sent witha link to Change the forgotten Password, Open the Inbox and Change your account password<br> <div class="section_title_h1">
            <a href="./index.php">Back to Login</a>
        </div>';
        }
    }
    
    $subject="Regd. the Forgotten Password";


    if(isset($_POST['updatePwd']))
    {
        if($_POST['Email']=="" && $_POST['rollno']=="")
        {
            echo"Fill Either of two Options";
        }
        else
        {
            if($_POST['rollno'])
            {
                $findResult = $document->findOne(
                    ['roll_no' => $_POST['rollno']]);
                    if($findResult)
                    {
                        $actual_link = "http://$_SERVER[HTTP_HOST]/hostel/"."forget-password.php?id=".$_POST['rollno']."&code=".$code;
    $body="
    <img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
    <div style='background-color:#fffadb;'><span style='margin-left: 15px;'><br>Dear <b>".strtoupper($findResult['name'])."</b>,</span><br><p>
    <span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!</span><br>
    <span style='margin-left: 15px;'>We have recieved your request for changing the NITPy Hostel account password.</span><br><br>
    <center>Click on the below link on forget password your account.<br>
    <a href='".$actual_link."'> <button style='background-color: #ffff00;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;'>Change Password</button></a><br><br>
                  
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
    $body1="
    <img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
    <div style='background-color:#fffadb;'><span style='margin-left: 15px;'><br>Dear <b>".strtoupper($findResult['name'])."</b>,</span><br><p>
    <span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!</span><br>
    <span style='margin-left: 15px;'>We have recieved your request for changing the NITPy Hostel account password.</span><br><br>
    <center>Click on the below link on forget password your account.<br>
    <a href='".$actual_link."'> <button style='background-color: #ffff00;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;'>Change Password</button></a><br><br>
                  
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
    $updateQuery = $document->updateOne(['roll_no' => $findResult['roll_no']], 
    ['$set' => ['otp' => $code]]);
                        send_mail($findResult['p_email'],$body,$body1, $subject);
                       
                    }
                    else{

                        echo "Rollno Not Found";
                    }

            }
            else if($_POST['Email'])
            {   
                
                $findResult = $document->findOne(
                    ['p_email' => $_POST['Email']]);
                    if($findResult)
                    {
                        $actual_link = "http://$_SERVER[HTTP_HOST]/hostel/"."forget-password.php?id=".$_POST['rollno']."&code=".$code;
                        $body="
    <img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
    <div style='background-color:#fffadb;'><span style='margin-left: 15px;'><br>Dear <b>".strtoupper($findResult['name'])."</b>,</span><br><p>
    <span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!</span><br>
    <span style='margin-left: 15px;'>We have recieved your request for changing the NITPy Hostel account password.</span><br><br>
    <center>Click on the below link on forget password your account.<br>
    <a href='".$actual_link."'> <button style='background-color: #ffff00;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;'>Change Password</button></a><br><br>
                  
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
    $body1="
    <img  alt='logo' src='cid:my-attach' style='width: 100%;  height: auto;'>
    <div style='background-color:#fffadb;'><span style='margin-left: 15px;'><br>Dear <b>".strtoupper($findResult['name'])."</b>,</span><br><p>
    <span style='margin-left: 15px;'>Greetings from NITPy Online Hostel management!!</span><br>
    <span style='margin-left: 15px;'>We have recieved your request for changing the NITPy Hostel account password.</span><br><br>
    <center>Click on the below link on forget password your account.<br>
    <a href='".$actual_link."'> <button style='background-color: #ffff00;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;'>Change Password</button></a><br><br>
                  
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
    $updateQuery = $document->updateOne(['roll_no' => $findResult['roll_no']], 
    ['$set' => ['otp' => $code]]);
    
        send_mail($findResult['p_email'],$body,$body1, $subject);
                       
                    }
                    else{

                        echo "Email Not Found";
                    }

            }


        }

    }

    ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <title></title>
</head>
<body>
    <div class="container center-align">
        <div class="img-ctn-h1 margin-center">
            <h1>Choose the option</h1>
        </div>
        <form action="" method="post" class="form-cont">                
            <div class="form-group">
                <label for="rollno">Enter Roll No.</label>
                <input type="text" class="form-control spec-1" name="rollno" placeholder="Enter Roll No." value="">
            </div>
            <h5> OR </h5>
            <div class="form-group">
                <label for="Email">Enter Registered Email Id</label>
                <input type="email" class="form-control spec-1" name="Email" placeholder="Enter Email Id" value="">
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="updatePwd" value="Submit" >
        </form>
    </div>
</body>



