<?php 
   session_start();
   require_once "../vendor/autoload.php";
   date_default_timezone_set("Asia/Kolkata");
   error_reporting(0);
   $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("01-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
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
                            if(isset($_POST['update-grievance']))
                            {
            
                                $nh = $_POST['grievance-header'];
                                $nc = $_POST['grievance-content'];
                                
                                $room=$af['room_no'.$semyear];
                                $name= $af["name"]; 
                                $client = (new MongoDB\Client);
                                $collection = $client->hostel;
                                $document = $collection->grievance;
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
                                $grievanceid="GRV".$invID;
                                $upload_date = date("l d-m-Y H:i");
                                $insertStmt = $document->insertOne([
                                    'grievance_header' => $nh, 
                                    'grievance_content' => $nc, 
                                    'roll_no' => $id, 
                                    'name' => $name, 
                                    'grievance_id' => $grievanceid, 
                                    'upload_date' => $upload_date, 
                                    'status' =>$status,
                                    'room_no'.$semyear =>$room,
                                    'p_mobile' =>$af['p_mobile']
                                ]);
                                echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The grievance has been successfully uploaded with reference id: <b>". $grievanceid."</b>
                            </div>";
                               
                            }
                        ?>
                       
                        <div class="img-ctn-h1">
                            <h1>Update grievance</h1>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="grievance-header">Enter Grievance Title</label>
                            <input type="text" class="form-control" name="grievance-header" placeholder="Enter Grievance Title" required>
                        </div>
                        <div class="form-group">
                            <label for="grievance-content">Enter Grievance Content</label>
                            <textarea name="grievance-content" class="grievance-body" cols="30" rows="10" placeholder="Enter Grievance Body"></textarea>
                        </div>
                        <div class="form-group center-align">
                            <input type="submit" class="btn btn-primary img-ctn-btn" name="update-grievance" value="Submit">
                        </div>
                    </form>
                       </div>
            </body>
                    <?php
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->grievance;
                        $asf = $document->find(['roll_no' => $id, 'status' => "Acknowledged"]); 
                         if($asf)
                         {
                        foreach($asf as $af){ 
                            $grivid= $af['grievance_id'];
                            echo " <div class='alert alert-success index-alert-upd' role='alert'>
                        
                        
                        <p class='trans'>The grievance <span style='font-weight:bold;'class='trans'> ". $grivid." </span>
                        titled ".$af['grievance_header']." <br>has been acknowleged by 
                        <span class='trans' style='font-weight:bold;'>". $af['w_name']." with id: ".$af['w_id']." on ".$af['ack_time']."</span></p>";
                        
                        
                        echo "<form action='grie-verify.php?regno=".$id."&giveno=". $grivid."' method='post'class='trans'>"; 
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