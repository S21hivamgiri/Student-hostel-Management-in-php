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
                $room_select = htmlspecialchars($_GET["room_select"]);
                $allEntries = $document->find(['role'=> $room_select]);
                echo '
                <tr>
               <td class="section_sub_title make-entry-table-title">Id</td>
                    <td class="section_sub_title make-entry-table-title">Visitor Name</td>
                    <td class="section_sub_title make-entry-table-title">Phone Number</td>
                    <td class="section_sub_title make-entry-table-title">Approved by</td>
                    <td class="section_sub_title make-entry-table-title">In Time</td>
                    <td class="section_sub_title make-entry-table-title">In Date</td>
                    <td class="section_sub_title make-entry-table-title">Out Time</td>
                    <td class="section_sub_title make-entry-table-title">Out Date</td>
                    <td class="section_sub_title make-entry-table-title">Update Entry</td>
                </tr>';
                if($allEntries){
                    foreach ($allEntries as $ae) {
                        
                            echo "
                                <tr>
                                    
                                        <td class='grey make-entry-table-title'>".$ae['id']."</td>
                                        <td class='grey make-entry-table-title'>".$ae['vis_name']."</td>
                                        <td class='grey make-entry-table-title'>".$ae['vis_number']."</td>
                                       
                                        <td class='grey make-entry-table-title'>".$ae['name']."</td>
                                        
                                         <td class='grey make-entry-table-title in-time'>
                                            ".$ae['in_time']."   </td>
                                        <td class='grey make-entry-table-title'>".$ae['in_date']."</td>
                                        <td class='grey make-entry-table-title in-time'>
                                           ".$ae['out_time']."
                                        </td>
                                        <td class='grey make-entry-table-title in-date'>
                                            ".$ae['out_date']."
                                        </td>
                                     
                                </tr>
                                ";
                        
                    }
                }
            ?>
            </table>
        </div>
    </div>
</body>
</html>