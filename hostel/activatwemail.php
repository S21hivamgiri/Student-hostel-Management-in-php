<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    $yearfull= date("Y");
      
    $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("10-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
?>
<!DOCTYPE html>
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
        <div class="activate-element">
            
            <br><br>
            <form action="" method="POST">
                <?php 
                     
                        $roll = htmlspecialchars($_GET["id"]);
                        $code  =htmlspecialchars($_GET["code"]);
                        echo'<input type="text" name="6code"  class="code-field" value= '.$code.'>';
                        $div=   '<div class="section_title_h1">
                        <a href="./student/view-profile.php?regno='.htmlspecialchars($_GET["id"]).'">See  Profile</a>
                    </div>';
                       
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;

                        $findResult = $document->findOne(
                            ['wdn_id' => $roll]);
                        if($findResult)
                        {

                            if($findResult['stat']==3)
                            {
                                if($findResult['otp']==$code)
                                {
                            $updateResult = $document->updateOne(
                            ['wdn_id' => $roll],
                            ['$set' => [
                         
                                'stat'=>1
                            ]]
                        );
                      
                        echo '<p>Congratulations! You email has been successfully verified</p>
                        Your username is: <b>'.$findResult['username'].'</b> <br>Username  is Case sensitive
                        and can be changed later based on convinience';

                       
                    echo $div;
                    echo '<div class="section_title_h1">
                        <a href="./index.php">Login Account</a>
                    </div>';
                    
                    }

                    else
                    {
                        echo '<div class="alert alert-danger notify acti-no" role="alert">
                                    Incorrect Code! Try Again!
                                </div>';  
                    }

                }
                    else if($findResult['stat']==1)
                    
                    {
                        echo'<div class="alert alert-danger notify" role="alert">
                            Account already Activated! Try logging in!
                        </div>';
                        
                       
                    echo $div;
                    echo '<div class="section_title_h1">
                        <a href="./index.php">Login Account</a>
                    </div>';
                    
                    }

                }
                    else
                    {
                        echo '<div class="alert alert-danger notify" role="alert">
                            No such record Found! Try registering again!
                        </div>';
                    }

                                
                            
                        
                    ?>
                
               </form>
        </div>
	</body>
    <script src="assets/js/bootstrap.min.js"></script>

</html>