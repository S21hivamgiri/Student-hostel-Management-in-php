<?php 
    session_start();
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
            <h1>Make Entry</h1>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="text" name="name" placeholder="Enter Name">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="text" name="rollno" placeholder="Enter Roll Number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                    <input type="text" name="out-time" value="<?php echo date("h:i A"); ?>" readonly>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                    <input type="text" name="in-time" value="<?php echo date("h:i A"); ?>" readonly>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button-col">
                    <input type="submit" name="make-entry" value="Make Entry" class="btn btn-primary cancelbtn">
                </div>
            </div>
        </form>
    </div> 
    <div class="container">
        <div>
            <table>
            <?php 
                require_once "../vendor/autoload.php";

                $client = (new MongoDB\Client);
                $collection = $client->hostel;
                $document = $collection->register;

                $allStudents = $document->find();
                echo '<tr>
                    <td class="section_sub_title">Name of student</td>
                    <td class="section_sub_title">Roll Number</td>
                    <td class="section_sub_title">View Status</td>
                </tr>';
                if(isset($_POST['search-std']))
                {
                    $regno = strtoupper($_POST['regno']);
                    $roomno = strtoupper($_POST['roomno']);
                    $floorno = $_POST['floor-select'];
                    $hostel = $_POST['hostel-select'];

                    if($regno)
                    {
                        foreach($allStudents as $as)
                        {
                            if($as['roll_no'] == $regno && $as['role'] == 'Student')
                            {
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
                            if($as['room_no'] == $roomno && $as['role'] == 'Student')
                            {
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
                            if($as['floorno'] == $floorno && $as['role'] == 'Student')
                            {
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
                            if($as['hostelno'] == $hostel && $as['role'] == 'Student')
                            {
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