<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    date_default_timezone_set("Asia/Kolkata");
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
                $document = $collection->register;
                $allEntries = $document->find();
                echo '
                <tr>
                    <td class="section_sub_title make-entry-table-title-small">Id</td>
                    <td class="section_sub_title make-entry-table-title-small">Student Name</td>
                    <td class="section_sub_title make-entry-table-title-small">Roll Number</td>
                    <td class="section_sub_title make-entry-table-title-small">Phone Number</td>
                    <td class="section_sub_title make-entry-table-title-small">Room Number</td>
                    <td class="section_sub_title make-entry-table-title-small">Out Time</td>
                    <td class="section_sub_title make-entry-table-title-small">Out Date</td>
                    <td class="section_sub_title make-entry-table-title-small">In Time</td>
                    <td class="section_sub_title make-entry-table-title-small">In Date</td>
                </tr>';
                $count = 0;
                $room_select = htmlspecialchars($_GET["room_select"]);
                if($allEntries){
                    foreach ($allEntries as $ae) {
                        if($ae['role'] == $room_select)
                        {
                            echo "
                                <tr>
                                    <form method='POST' action='updateentry.php?uid=".$ae['student_name']."'>  
                                        <td class='grey make-entry-table-title-small'>".$ae['id']."</td>
                                        <td class='grey make-entry-table-title-small'>".$ae['student_name']."</td>
                                        <td class='grey make-entry-table-title-small'><span class='transpan'>".$ae['student_roll_number']."</span></td>
                                        <td class='grey make-entry-table-title-small'>".$ae['student_number']."</td>
                                        <td class='grey make-entry-table-title-small'>".$ae['student_room_no']."</td>
                                        <td class='grey make-entry-table-title-small'>".$ae['out_time']."</td>
                                        <td class='grey make-entry-table-title-small'>".$ae['out_date']."</td>
                                        <td class='grey make-entry-table-title-small in-time'>".$ae['in_time']."</td>
                                        <td class='grey make-entry-table-title-small in-date'>".$ae['in_date']."</td>
                                    </form>
                                </tr>
                                ";
                        }
                    }
                }
            ?>
            </table>
        </div>
    </div>
</body>
</html>