<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    date_default_timezone_set("Asia/Kolkata");
    // error_reporting(0);
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
    <div>
        <div>
            <table>
            <?php 
                require_once "../vendor/autoload.php";

                $client = (new MongoDB\Client);
                $collection = $client->hostel;
                $document = $collection->register;
                $allEntries = $document->find(["role" => "In/Out"]);
                echo '
                <tr>
                    <td class="section_sub_title make-entry-table-title">Id</td>
                    <td class="section_sub_title make-entry-table-title">Student Name</td>
                    <td class="section_sub_title make-entry-table-title">Roll Number</td>
                    <td class="section_sub_title make-entry-table-title">Phone Number</td>
                    <td class="section_sub_title make-entry-table-title">Room Number</td>
                    <td class="section_sub_title make-entry-table-title">Exp. Out Time</td>
                    <td class="section_sub_title make-entry-table-title">Out Date</td>
                    <td class="section_sub_title make-entry-table-title">Year</td>
                    <td class="section_sub_title make-entry-table-title">Update Entry</td>
                </tr><tr><td colspan="9" class="section_sub_title make-entry-table-title">Reason</td></tr>';
            
              if($allEntries){
                    foreach ($allEntries as $ae) {


                        if(strtotime($ae['out_date'])==strtotime(date("Y-m-d")))
                        { 
                       if(($ae['out_time'] == ''))
                        {
                            echo "
                                <tr class='list-item'>
                                    <form method='POST' action='updateoutentry.php?uid=".$ae['id']."&role=".'In/Out'."'>  
                                        <td class='section_sub_title make-entry-table-title'>".$ae['id']."</td>
                                        <td class='section_sub_title make-entry-table-title'>".$ae['student_name']."</td>
                                        <td class='section_sub_title make-entry-table-title'><span class='trans'>".$ae['student_roll_number']."</span></td>
                                        <td class='section_sub_title make-entry-table-title'>".$ae['student_number']."</td>
                                        <td class='section_sub_title make-entry-table-title'>".$ae['student_room_no']."</td>
                                        <td class='section_sub_title make-entry-table-title'>".$ae['exp_out_time']."</td>
                                          <td class='section_sub_title make-entry-table-title'>".$ae['out_date']."</td>
                                        <td class='section_sub_title make-entry-table-title'>".$ae['sem']."</td>  
                                                                                                                
                                        <td class='section_sub_title make-entry-table-title'>  
                                            <input type='submit' value='Update Entry' name='update-entry' class='btn btn-primary no-border'>
                                        </td>
                                    </form>
                                </tr><tr><td colspan='9' class='section_sub_title make-entry-table-title'>".$ae['reason']."</td>  
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
    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
    var d = new Date();
    var time = formatAMPM(new Date);
    var day = d.getDate();
    var month = d.getMonth();
    month++;
    var year = d.getFullYear();
    var date = day+"-"+month+"-"+year;
    var list = document.querySelectorAll('.list-item');
    for(var i = 0; i<list.length; i++)
    {
        list[i].addEventListener('click', function()
        {
            $(this).find('.empty-field-1').text() = time;
            $(this).find('.empty-field-2').text() = date;
        });
    }
</script>
</html>