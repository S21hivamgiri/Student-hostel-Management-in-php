<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$result)
    {
        header("location:../index.php");
    }

	?> 
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  
    <div class="centerstage row">
       
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 infostage">
            <div class="container initiate-file">
                <div class="feedback">
                    <form action="" method="POST">
                    <?php 
                        $client = (new MongoDB\Client);
                        $collection = $client->hostel;
                        $document = $collection->users;
                        
                        $month = date('m');
                        $day = date('d');
                        $year = date('Y');
                        $hour= date("H");
                        $min=date("i");
                        $sec=date("s");
                        $today = $year . '-' . $month . '-' . $day;
                        $todate= date('Y-m-d', strtotime($today . " + 2 day"));
                        if(isset($_POST['activate-Feed']))
                        {
                            $tottime=$_POST['appt-date'].' '. $_POST['appt-time'];
                            $doom_time= strtotime($tottime);
                            $updateQuery = $document->updateOne(['role' => "Warden"], 
                            ['$set' => ['feed' => "1","feed_time"=>$doom_time]]);
                            $updateQuery = $document->updateOne(["role"=>"Student"], 
                            ['$set' => ['feed' => "1","feed_time"=>$doom_time]]);
                            
                            setcookie("doom_time",$doom_time , time()+30*24*60*60);
                            setcookie("feed","1" , time()+30*24*60*60);
                            header("Refresh:0");
                           
                            
                           
                          echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                            The Feedback system is Activated
                         </div>";
          
        
                            }      

                    ?>
                       <div class="section_sub_title spread">
                            <h1>Activate the feedback</h1>
                        </div>
                        
                        <label for="appt-time">Choose date and time for closing the feedback : </label>
                        
                        <input id="appt-time" type="time" name="appt-time" value="22:00">
                        <input id="appt-date" type="date" name="appt-date" value="<?php echo $today;?>" min="<?php echo $today;?>" max="<?php echo $todate;?>">
                        <input type="submit" name="activate-Feed" value="Activate Feedback" class="btn btn-primary img-ctn-btn">
                        
                    </form>
                    <p id="demo"></p>
                        <div id="idid"></div>
                        
                </div>
            </div>
        </div>
    </div>


    
    <script src="assets/js/scripts.js"></script>
    <script>

    var x = setInterval(function() {
        var now = new Date().getTime();
    var distance = <?php echo $_COOKIE["doom_time"]*1000?>-now;
    
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("demo").innerHTML = "<span class='btn btn-success'><h2 class='trans'>Feedback is activated </h2> Feedback closes at:   "+days + "d " + hours + "h "
    + minutes + "m " + seconds + "s </span>";

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "<p class='btn btn-danger'>FEED-BACK DEACTIVATED</p>";
        if( <?php echo $_COOKIE["feed"]?>==1)
        window.location.href = "./deactivate.php";
    }
    }, 1000);
    </script>