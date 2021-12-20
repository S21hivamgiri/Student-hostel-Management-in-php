<?php 
   session_start();
   require_once "../vendor/autoload.php";
   date_default_timezone_set("Asia/Kolkata");
   error_reporting(0);
   
   $client = (new MongoDB\Client);
   $collection = $client->hostel;
   $document = $collection->users;
   
   $af = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])]);
   if(!$af){
       header("location:../index.php");
   }
    $id= $af["roll_no"];  
    
?>
           
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
                <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="../assets/css/style.css">
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
                <title></title>
            </head>
            <body>
                <div class="cp-div pwd-wide">
               
                    <form action="" method="post">
                        <?php 
                            if(isset($_POST['update-complaint']))
                            {
            
                                $nh = $_POST['complaint-header'];
                                $nc = $_POST['complaint-content'];
                                
                                  
                                $name= $af["name"]; 
                                $client = (new MongoDB\Client);
                                $collection = $client->hostel;
                                $document = $collection->complaint;
                                $status="Submitted";
                                $count=$document-> count();
            
                                if($count == 0)
                                {
                                    $count++;
                                   
                                }
                                else{
                                    $count = $count + 1;
                                  
                                }
                                $invID = str_pad($count, 7, '0', STR_PAD_LEFT);
                                $complaintid="CMP".$invID;
                                $upload_date = date("l d-m-Y H:i");
                                $insertStmt = $document->insertOne([
                                    'complaint_header' => $nh, 
                                    'complaint_content' => $nc, 
                                    'roll_no' => $id, 
                                    'name' => $name, 
                                    'complaint_id' => $complaintid, 
                                    'upload_date' => $upload_date, 
                                    'status' =>$status,
                                    'contact'=>$af['p_mobile']
                                ]);
                                echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The complaint has been successfully uploaded with reference id: <b>". $complaintid."</b>
                            </div>";
                               
                            }
                        ?>
                  
                        <div class="img-ctn-h1">
                            <h1>Update Complaint</h1>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="complaint-header">Enter Complaint Title</label>
                            <input type="text" class="form-control" name="complaint-header" placeholder="Enter complaint Title" required>
                        </div>
                        <div class="form-group">
                            <label for="complaint-content">Enter Complaint Content</label>
                            <textarea name="complaint-content" class="complaint-body" cols="30" rows="10" placeholder="Enter Complaint Body"></textarea>
                        </div>
                        <div class="form-group center-align">
                            <input type="submit" class="btn btn-primary img-ctn-btn" name="update-complaint" value="Submit">
                        </div>
                    </form>
                  
                </div>
            </body>
              <?php
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->complaint;
                        $asf = $document->find(['roll_no' => $id, 'status' => "Acknowledged"]); 
                         if($asf)
                         {
                        foreach($asf as $af){ 
                            $grivid= $af['complaint_id'];
                            echo " <div class='alert alert-success index-alert-upd' role='alert'>
                        
                        
                        <p class='trans'>The complaint <span class='trans' style='font-weight:bold'> ". $grivid." </span>
                       
                        titled ".$af['complaint_header']." <br> has been acknowleged by 
                        <span class='trans' style='font-weight:bold'>". $af['w_name']." with id: ".$af['w_id']." on ".$af['ack_time']."</span></p>";
                        
                        
                        echo "<form action='grie-verify.php?regno=".$id."&giveno=". $grivid."' method='post' class='trans'>"; 
                        echo"<input type='submit' class='btn btn-primary img-ctn-btn' name='clear' value='Clear'>
                        </form></div>";

                    
                        }
                    }
                        ?>
            <script src="../assets/js/jquery-2.2.4.min.js"></script>
            <script src="../assets/js/popper.min.js"></script>
            <script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
            <script src="../assets/js/scripts.js"></script>
            </html>