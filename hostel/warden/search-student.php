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
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <div class="search-bar">
        <div class="section_title_h1">
            <h1>Search Student</h1>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="roll">Roll No.<label>
                    <input id="roll" type="text" name="regno" placeholder="Registration Number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="roomno">Room No.<label>
                    
                    <input id="roomno" type="text" name="roomno" placeholder="Room Number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                <label for="floor">Floor No.<label><br>
                    <select id="floor" name="floor-select" class="floor-select-st">
                        <option value="" hidden default value="Floor Number"></option>
                        <option value="Ground">Ground Floor</option>
                        <option value="First">First Floor</option>
                        <option value="Second">Second Floor</option>
                        <option value="Third">Third Floor</option>
                        <option value="Fourth">Fourth Floor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                <label for="hostel">Hostel<label><br>
                    <select id="hostel" name="hostel-select" class="floor-select-st" placeholder="Hostel">
                       <?php
 $document = $collection->academics;
  $find=$document->find(['role'=>'hostel']);  
    
    
        foreach($find as $as)
        {
        echo "<option value='".$as['hostel']."'>".$as['hostel']."</option>";
        }
        ?>
                       </select>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button-col">
                    <input type="submit" name="search-std" value="Search Student" class="btn btn-primary cancelbtn">
                </div>
            </div>
        </form>
    </div> 
    <div class="container">
        <div>
            <table>
            
<?php
                $document = $collection->users;

                $allStudents = $document->find();
                $fields = array('name','stuyear', 'roll_no','dept','course','hostel','Room No.','email','mobile');
               
                if(isset($_POST['search-std']))
                {
                    echo '<tr>
                    <td class="section_sub_title">Name of student</td>
                    <td class="section_sub_title">Roll Number</td>
                    <td class="section_sub_title">View Status</td>
                </tr>';
                    $regno = strtoupper($_POST['regno']);
                    $roomno = strtoupper($_POST['roomno']);
                    $floorno = $_POST['floor-select'];
                    $hostel = $_POST['hostel-select'];
                    
                    if($regno)
                    {
                        foreach($allStudents as $as)
                        {
                            if( ($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'||$as['role'] == 'student-council')&& $as['roll_no'] == $regno)
                            {
                                
                                $_SESSION['filename'] = "info" .$regno. ".csv";
                                     //create a file pointer
                                     
                
               
               
                                           
                                    
                                    //output each row of the data, format line as csv and write to file pointer
                                    
      
                                    //move back to beginning of file
                                    $lineData = array($as['name'], $as['stuyear'], $as['roll_no'], $as['dept'],$as['course'],$as['hostelno'.$semyear],$as['room_no'.$semyear],$as['p_email'],$as['p_mobile']);   

                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                ";

                                
                            
                            }
                        }
                    }
                    else if($roomno && $hostel)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['room_no'.$semyear] == $roomno && $as['hostelno'.$semyear] == $hostel &&($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'))
                            {
                                    
                                $_SESSION['filename'] = "info" .$roomno. $hostel. ".csv";
                    
                                   
                                    
                                    //output each row of the data, format line as csv and write to file pointer
                                  
                                        $lineData = array($as['name'], $as['stuyear'], $as['roll_no'], $as['dept'],$as['course'],$as['hostelno'.$semyear],$as['room'.$semyear],$as['p_email'],$as['p_mobile']);
                                 
                                 

                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                "; 
                            }
                        }                        
                    }
                    else if($roomno)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['room_no'.$semyear] == $roomno && ($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'))
                            {

                                $_SESSION['filename'] = "info" .$roomno. ".csv";
                    
                                   
                                    
                                //output each row of the data, format line as csv and write to file pointer
                              
                                    $lineData = array($as['name'], $as['stuyear'], $as['roll_no'], $as['dept'],$as['course'],$as['hostelno'.$semyear],$as['room'.$semyear],$as['p_email'],$as['p_mobile']);
                                
                             

                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                "; 
                            }
                        }                        
                    }
                    else if($floorno && $hostel)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['floorno'] == $floorno && $as['hostelno'] == $hostel && ($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'))
                            {
                                $_SESSION['filename'] = "info" .$floorno.' '. $hostel. ".csv";
                    
                                   
                                    
                                //output each row of the data, format line as csv and write to file pointer
                              
                                  
                             
                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                ";                                 
                            }
                        }                        
                    }
                    else if($floorno)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['floorno'] == $floorno &&($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'))
                            {
                                   $_SESSION['filename'] = "info" .$floorno.".csv";
                    
                                   
                                    
                                //output each row of the data, format line as csv and write to file pointer
                              
                                    $lineData = array($as['name'], $as['stuyear'], $as['roll_no'], $as['dept'],$as['course'],$as['hostelno'.$semyear],$as['room'.$semyear],$as['p_email'],$as['p_mobile']);
                                
                             
                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                ";                                 
                            }
                        }                        
                    }
                    else if($hostel)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['hostelno'] == $hostel &&($as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr'))
                            {

                                $_SESSION['filename'] = "info" . $hostel. ".csv";
                           
                                //output each row of the data, format line as csv and write to file pointer
                              
                                    $lineData = array($as['name'], $as['stuyear'], $as['roll_no'], $as['dept'],$as['course'],$as['hostelno'.$semyear],$as['room'.$semyear],$as['p_email'],$as['p_mobile']);
                                
                             
                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Status' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                ";                                 
                            }
                        }                        
                    }
 
                    echo'                    
                    <form action="" method="POST">
                <div class="form-group">
            
           <input type="button" name="course" value="Print To CSV" class="btn btn-primary img-ctn-btn">
           </div>
           </form>';
}            
            
            ?>




                    
            </table>
        </div>
    </div>
</body>
<script>
    var list = document.querySelectorAll('.pending-list-item');
    for(var i = 0; i<list.length; i++)
    {
        list[i].addEventListener('click', function(){
            var regno = $(this).find('span').text();
            window.open("../student/view-profile.php?regno="+regno);
        });
    }
</script>
</html>