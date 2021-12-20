<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    // error_reporting(0);

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$result){
        header("location:../index.php");
    }
     $year=date("Y");
  $ar=date("y");
  $cur_date=date("Y-m-d");
  if(strtotime($cur_date)>=strtotime("10-06-".$year))
  
  $semyear= $year.'-'.($ar+1);
  
  else
  $semyear= ($year-1).'-'.($ar);
$t =strtotime($result['doj']);
$cur_date=date("Y-m-d");
$j_year=date("Y",$t);
$ti=strtotime("10-06-".$j_year);
$r=strtotime($cur_date);
$diff=$r-$ti;
$year=$diff/(365*60*24*60);
$i=(int) $year+1;
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($i %100) >= 11 && ($i%100) <= 13)
   $abbreviation = 'th';
else
   $abbreviation = $ends[$i % 10];
  $stuyear=$i.$abbreviation;


  
  
   if( $result['room_no'.$semyear])
   $room= $result['room_no'.$semyear];
   else{

    $room= "<b>Room not Allocated</b>";
   }
  
    $name=$result['name'];
    $roll_no= $result['roll_no'];
    $feed=$result['feed'];
    $dept=$result['dept'];
    $veg=$result['veg'];
    $hostel=$result['hostelno'.$semyear];
    $course=$result['course'];
    $year=$result['year'];
    $date=date("Y-m-d h:i:sa",$result["feed_time"]);

    ?> 




    



    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script>


function myFunction(val,id)
{
     var x = document.getElementById("demo"+id);
     x.style.display = "block";

 x.innerHTML = val;
var i;var total = 0;;

for (i = 1; i <= 12; ++i) 
var total=total+parseInt(document.getElementById("demo"+i).innerText);
 document.getElementById("tot").innerHTML = "<p class='btn btn-warning'>"+total+"/60</h2>";
}



        var x = setInterval(function() {
            var now = new Date().getTime();
        var distance = <?php echo $result["feed_time"]*1000?>-now;
        
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("mydemo").innerHTML = "<span class='btn btn-success'><h2 class='trans'>Feedback is activated </h2> Feedback closes at: <?php echo $date; ?><br>Time left:  "+days + "d " + hours + "h "
        + minutes + "m " + seconds + "s </span>";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("mydemo").innerHTML = "<h2 class='btn btn-danger'>FEED-BACK DEACTIVATED</h2>";
        }
        }, 1000);
    </script>
    <div class="centerstage row">
       
        <div class="">
            <div class="feedback">
                <form action="" method="POST">
                <?php 
                    $client = (new MongoDB\Client);
                    $collection = $client->hostel;
                    $document = $collection->feedback;

                    if(isset($_POST['giveFeed']))
                    {

                        if($feed==1){
                        $v01 = $_POST['q1_value'];
                        $v02 = $_POST['q2_value'];
                        $v03 = $_POST['q3_value'];
                        $v04 = $_POST['q4_value'];
                        $v05 = $_POST['q5_value'];
                        $v06 = $_POST['q6_value'];
                        $v07 = $_POST['q7_value'];
                        $v08 = $_POST['q8_value'];
                        $v09 = $_POST['q9_value'];
                        $v10 = $_POST['q10_value'];
                        $v11 = $_POST['q11_value'];
                        $v12 = $_POST['q12_value'];
    
                        $r1 = $_POST['restQuest1'];
                        $r2 = $_POST['restQuest2'];
                        $poll = $_POST['Poll'];

                        $insertStmt = $document->insertOne([
                            'q1' => $v01, 
                            'q2' => $v02, 
                            'q3' => $v03, 
                            'q4' => $v04, 
                            'q5' => $v05, 
                            'q6' => $v06, 
                            'q7' => $v07, 
                            'q8' => $v08, 
                            'q9' => $v09, 
                            'q10' => $v10, 
                            'q11' => $v11,
                            'q12' => $v12, 
                            'r1' => $r1,
                            'r2' => $r2,
                            'dept'=>$result['dept'],
                            'course'=>$result['course'],
                            'stuyear'=>$stuyear,
                            'year'=>date("Y"),
                            'month'=>date("m"),
                            'name' =>$name,
                            'roll_no'=>$roll_no,
                            'poll' => $poll,
                            'veg'=>$veg,
                            'hostel'=>$hostel
                        ]);
                        header("location:newfilesuccess.php");
                        }
                        else 
                        {
                            header("location:feedfail.php");
                        }

                    }
                ?>
                    <div class="section_sub_title spread">
                        <h1>Rate Your Caterer</h1>
                    </div>
                    <div class="center-align">
                        <p id="mydemo"></p>                            
                    </div>
                    <div class="row scoreMeasure" style='background-color:#ffc107'>
                        <div class="col-lg-6 btn btn-warning">
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Excellent: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/best.png" >5 Points</span></p>  
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Average: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/sad.png" >2 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Poor : <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/sadest.png" >1 Points</span></p>
                        </div>
                        <div class="col-lg-6 btn btn-warning">
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Very Good: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/happy.png" >4 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Good: <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/avg.png" >3 Points</span></p>
                            <p class="pClass" style='background-color:#ffc107;font-weight:bold'>Very Poor : <span class="spanClass trans"><img class="img-emoji" src="../assets/img/emojis/worsen.png" >0 Points</span></p>
                        </div>
                    </div>

                    <div class="questionBank">
                        <table class="questionTable">
                            <thead>
                                <tr class="firstRow">
                                    <td class='trans'>SNo.</td>
                                    <td class='trans'>Feedback Category</td>
                                    <td class='trans'>Points(0-5)</td>
                                    <td class='trans'>Value (0-5)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Quality of Food Served</td>
                                    <td>
                                        <table>
                                            <tr>  
                                                <td><label><input type="radio" name="q1_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,1)" src="../assets/img/emojis/worsen.png" ></label></td>  
                                                <td><label><input type="radio" name="q1_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,1)" src="../assets/img/emojis/sadest.png" ></label></td>
                                                <td><label><input type="radio" name="q1_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,1)" src="../assets/img/emojis/sad.png"></label></td>
                                                <td><label><input type="radio" name="q1_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,1)" src="../assets/img/emojis/avg.png"></label></td>
                                                <td><label><input type="radio" name="q1_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,1)" src="../assets/img/emojis/happy.png"></label></td>
                                                
                                                <td><label><input type="radio" name="q1_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,1)" src="../assets/img/emojis/best.png"></label></td>
                                            </tr>
                                        </table>
                                    </td>
                                   <td><button class="btn btn-warning disp" id='demo1' name="q1_value_check">0</button></td>
                                 </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Taste of Food</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q2_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,2)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q2_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,2)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q2_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,2)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q2_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,2)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q2_value" value="4" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(4,2)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q2_value" value="5" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(5,2)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                    <td><button class="btn btn-warning disp" id='demo2' name="q2_value_check">0</button></td> </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Cleanliness of Dining and Food Counter Area</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q3_value" value="0"  class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,3)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q3_value" value="1"  class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,3)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q3_value" value="2"  class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,3)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q3_value" value="3"  class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,3)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q3_value" value="4"  class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,3)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q3_value" value="5"  class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,3)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                 <td><button class="btn btn-warning disp" id='demo3' name="q3_value_check">0</button></td>                  
                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Cleanliness of Wash Basins</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q4_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,4)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q4_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,4)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q4_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,4)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q4_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,4)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q4_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,4)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q4_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,4)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                 <td><button class="btn btn-warning disp" id='demo4' name="q4_value_check">0</button></td>                
                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Cleanliness of Catering Staff</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q5_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,5)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q5_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,5)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q5_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,5)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q5_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,5)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q5_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,5)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q5_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,5)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                    <td><button class="btn btn-warning disp" id='demo5' name="q5_value_check">0</button></td> </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Cleanliness of Utensils</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q6_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,6)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q6_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,6)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q6_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,6)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q6_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,6)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q6_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,6)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q6_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,6)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                    <td><button class="btn btn-warning disp" id='demo6' name="q6_value_check">0</button></td></tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Courtesy of Catering Staff</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q7_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,7)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q7_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,7)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q7_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,7)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q7_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,7)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q7_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,7)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q7_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,7)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                 <td><button class="btn btn-warning disp" id='demo7' name="q7_value_check">0</button></td>                    
                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>Rush and Waiting time at the Food Counters (Note: Give low points if the waiting time is more and give high points if the waiting time is less)</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q8_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,8)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q8_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,8)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q8_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,8)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q8_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,8)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q8_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,8)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q8_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,8)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                             <td><button class="btn btn-warning disp" id='demo8' name="q8_value_check">0</button></td>  </tr>
                                <tr>
                                    <td>9.</td>
                                    <td>Serving of Drinking Water in Dining Area</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q9_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,9)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q9_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,9)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q9_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,9)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q9_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,9)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q9_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,9)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q9_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,9)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                   <td><button class="btn btn-warning disp" id='demo9' name="q9_value_check">0</button></td>   </tr>
                                <tr>
                                    <td>10.</td>
                                    <td>Adequate Quantity of Food Provided</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q10_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,10)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q10_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,10)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q10_value" value="2"  class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,10)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q10_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,10)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q10_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,10)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q10_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,10)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                               <td><button class="btn btn-warning disp" id='demo10' name="q10_value_check">0</button></td>    </tr>
                                <tr>
                                    <td>11.</td>
                                    <td>Waste Disposal Methodology</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q11_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,11)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q11_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,11)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q11_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,11)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q11_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,11)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q11_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,11)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q11_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,11)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                 <td><button class="btn btn-warning disp" id='demo11' name="q11_value_check">0</button></td>   </tr>
                                <tr>
                                    <td>12.</td>
                                    <td>Service and Punctuality</td>
                                       <td><table><tr>  
                    <td><label><input type="radio" name="q12_value" value="0" class="feed-point" required><img class="img-emoji" title="0" onclick="myFunction(0,12)" src="../assets/img/emojis/worsen.png" ></label></td>  
                    <td><label><input type="radio" name="q12_value" value="1" class="feed-point" required><img class="img-emoji" title="1" onclick="myFunction(1,12)" src="../assets/img/emojis/sadest.png" ></label></td>
                    <td><label><input type="radio" name="q12_value" value="2" class="feed-point" required><img class="img-emoji" title="2" onclick="myFunction(2,12)" src="../assets/img/emojis/sad.png"></label></td>
                    <td><label><input type="radio" name="q12_value" value="3" class="feed-point" required><img class="img-emoji" title="3" onclick="myFunction(3,12)" src="../assets/img/emojis/avg.png"></label></td>
                    <td><label><input type="radio" name="q12_value" value="4" class="feed-point" required><img class="img-emoji" title="4" onclick="myFunction(4,12)" src="../assets/img/emojis/happy.png"></label></td>
                    <td><label><input type="radio" name="q12_value" value="5" class="feed-point" required><img class="img-emoji" title="5" onclick="myFunction(5,12)" src="../assets/img/emojis/best.png"></label></td>
                    </tr></table></td>
                                    <td><button class="btn btn-warning disp" id='demo12' name="q12_value_check">0</button></td> </tr>
                              <tr>
                                    <td class='alert alert-danger' colspan="2">*All the above question are required</td>
                                    
                                    <td class='trans' style="font-weight:bold" >Total</td>
                                    <td class='trans'id='tot'></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="restQuest">
                        <p>1. Mention any other comments and suggestions for improving the Catering Service</p>
                        <textarea name="restQuest1" cols="30" rows="5" required></textarea>
                        <p>2. Mention any two positive aspects of the Caterer(optional)</p>
                        <textarea name="restQuest2" cols="30" rows="5"></textarea>
                        <p>3. Whether the same caterer can continue for the next semester? </p>
                        <label><input type="radio" name="Poll"  value="Yes" id="poll-yes" class="spec-2 feed-point" required><img class="img-emoji" src="../assets/img/emojis/yes.png" ></label></td>  
                            Yes
                
                        <label><input type="radio" name="Poll"  value="No" id="poll-yes" class="left-side spec-2 feed-point" required><img class="img-emoji" src="../assets/img/emojis/no.png" ></label></td>  
                            No
                    </div>
                    <br>
                    <div class="center-align">
                        <input type="submit" name="giveFeed" value="Submit Feedback" class="btn btn-primary img-ctn-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>