<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $af = $document->findOne(['username' => $_SESSION['username'], 'password' =>($_SESSION['password'])]);
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
              <?php 
                            if(isset($_POST['update-complaint']))
                            {

 $nc = $_POST['feed-content'];
 
                                $document = $collection->app_feedback;
$count=$document-> count();
            
                                if($count == 0)
                                {
                                    $count++;
                                   
                                }
                                else{
                                    $count = $count + 1;
                                  
                                }
                                $invID = str_pad($count, 7, '0', STR_PAD_LEFT);
                                $complaintid="FDBCK".$invID;

                             $upload_date = date("l d-m-Y H:i");

 $insertStmt = $document->insertOne([
                                    
                                    'feed-content' => $nc,
                                   
                                    'roll_no' => $id, 
                                    'name' => $af['name'], 
                                    'feedbacks_id' => $complaintid, 
                                    'upload_date' => $upload_date, 
                                    'contact'=>$af['p_email'],
                                    'role'=>"student"
                                ]);

if($insertStmt){
echo "  <div class='alert alert-success ' role='alert'>
                                The feedback has been successfully uploaded with reference id: <b>". $complaintid."</b>
                            </div>";
}
                            }
                                ?>
            <body>
                <div class="cp-div pwd-wide">
                  <form action="" method="post">
                 <div class="img-ctn-h1">
                            <h1>Enter Feed-Back</h1>
                        </div>
                        <br>
                      
                        <div class="form-group">
                            <label for="feed-content">Enter Feedback Content in details</label>
                            <textarea name="feed-content" class="complaint-body" cols="30" rows="10" placeholder="Describe in Details"></textarea>
                        </div>
                        <div class="form-group center-align">
                            <input type="submit" class="btn btn-primary img-ctn-btn" name="update-complaint" value="Submit">
                        </div>
                    </form>
                  
                </div>
            </body>