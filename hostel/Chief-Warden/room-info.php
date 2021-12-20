<?php
session_start();
   //error_reporting(0);
    require_once "../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    $room =   htmlspecialchars($_GET['room']);
    $hostel = htmlspecialchars($_GET['hostel']);
    $year=date("Y");
  $ar=date("y");
  $cur_date=date("Y-m-d");
  if(strtotime($cur_date)>=strtotime("10-06-".$year))
  
  $semyear= $year.'-'.($ar+1);
  
  else
  $semyear= ($year-1).'-'.($ar);


    $result = $document->find(['room_no'.$semyear=>$room,'hostelno'.$semyear=>$hostel]);
    
    $post=substr($room,0,1);
    
    if($post=='G')$floor="Ground";
    else if($post=='F')$floor="First";
    else if($post=='S')$floor="Second";
    else if($post=='T')$floor="Third";
    else if($post=='R')$floor="Fourth";
  ?>

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
            <h1>Room Allocation Information:<?php echo $room;?></h1>
        </div>
        <form method="POST">
        <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button-col">
                    <input type="submit" name="map" value="See Attendance Matrix" class="btn btn-primary">
                </div>
            </div>
                 </form>
               
        <div>
            <table>
<?php
            echo '<tr>
    <td class="section_sub_title">Name of student</td>
    <td class="section_sub_title">Roll Number</td><td class="section_sub_title">Attendance</td>
    <td class="section_sub_title">View Profile</td>
</tr>';

    foreach($result as $as)
                        {
                            if( $as['role'] == 'Student'||$as['role'] == 'mr'||$as['role'] == 'hr')
                            {
                                $document = $collection->leave;
                                $leave=$document->findOne(['roll_no' =>$as['roll_no'],'journey'=>1 ]);
                                  $document = $collection->register;
                  $search1 = $document->findOne(['student_roll_number'=>$as['roll_no'],'role'=>'In/Out','journey'=>"1" ]); 
                   
                                if($leave)
                                $attendance="<b><p style='color:red'>Absent</b></p>";
                                else if($search1)
                                $attendance="<b><p style='color:#0037ff'>Within Kkl</p>";
                               
                                else
                                $attendance="<b><p style='color:green'>Present</p>";
                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='regno'>". $as['roll_no'] ."</span></td>
                                        <td>".$attendance ."</td>
                                        
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Profile' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                ";
                            }
                            if( $as['role'] == 'Warden')
                            {
                                echo "
                                    <tr class='pending-list-item'>
                                        <td>". $as['name']."</td>
                                        <td><span class='wegno'>". $as['wdn_id'] ."</span></td>
                                        <td>Present</td>
                                        
                                        <td>
                                        <form action='' method='POST'>
                                            <input type='submit' value='View Profile' name='status-file' class='btn btn-primary'>
                                        </form>
                                        </td>
                                    </tr>  
                                    <script>
                                        var list = document.querySelectorAll('.pending-list-item');
                                        for(var i = 0; i<list.length; i++)
                                        {
                                            list[i].addEventListener('click', function(){
                                                var wegno = $(this).find('span').text();
                                                if(wegno)
                                                window.open('../warden/view-profile.php?regno='+wegno);
                                                
                                            });
                                        }
                                    </script>
                                   
                                ";
                            }
                        }
    
  ?>
  <tr>
  <td></td>
  <td></td>  
  <td></td>
  </tr>
  
  <?php
  
    $_SESSION['hostel-select']=$hostel;
    $_SESSION['floor-select']=$floor;
   if(isset($_POST['map']))
   {
    header("location:att-graph.php");

   }
   
    
   ?>
   </table>
   </div>
   <div class="section_title_h1">
            <h1>Room Accessories Information</h1>
        </div>
        
        <div>
            <table>
<?php
         $client = (new MongoDB\Client);
         $collection = $client->hostel;
         $document = $collection->room;
         $room = htmlspecialchars($_GET['room']);
         $hostel = htmlspecialchars($_GET['hostel']);
         $result = $document->findOne(['room_no'=>$room,'hostelno'=>$hostel]);   
    echo'<tr><td class="section_sub_title">Cots</td>  <td></td>  <td></td></tr>';
    echo '<tr>
    <td >'.$result["cot1"].'</td>
    <td >'.$result['cot2'].'</td>
    <td >'.$result['cot2'].'</td>
</tr>';
echo'<tr><td class="section_sub_title">Chair</td>  <td></td>  <td></td></tr>';
echo '<tr>
<td >'.$result["chair1"].'</td>
<td >'.$result['chair2'].'</td>
<td >'.$result['chair3'].'</td>
</tr>';
echo'<tr><td class="section_sub_title">Table</td>  <td></td>  <td></td></tr>';
echo '<tr>
<td>'.$result["tab1"].'</td>
<td>'.$result['tab2'].'</td>
<td>'.$result['tab3'].'</td>
</tr>';
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