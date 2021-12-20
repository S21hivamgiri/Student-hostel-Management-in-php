<?php 
    session_start();
    require_once "../vendor/autoload.php";

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
     error_reporting(0);
     $year=date("Y");
     $ar=date("y");
     $cur_date=date("Y-m-d");
     if(strtotime($cur_date)>=strtotime("01-06-".$year))
 
     $semyear= $year.'-'.($ar+1);
 
     else
     $semyear= ($year-1).'-'.($ar);
    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])]);
    if(!$result){
        header("location:../index.php");
    }
	
	if($result['hostelno'.$semyear]) $hostel=$result['hostelno'.$semyear];else   header("location:fail-menu.php");
	
	
	   $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->menu;

    $result = $document->findOne(['hostelno' => $hostel]);
    if(!$result){
     echo' <div class="centerstage row">
        
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 infostage">
          <div class="initiate-file if">
              <div class="alert alert-danger" role="alert">
        <br>
        <br>
        <br>
             You Are not Allocated till Now
        <br>
        OR
        <br>
        Feedback system is being Deactivated
        
              </div>
          </div>
      </div>
  </div>
  <script src="assets/js/scripts.js"></script>';
    }
	
	
	
?> <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
<link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
<body>
    <div class="centerstage">
        <div class="container menu-style">
            <div class="feedback">
                <div class="img-ctn-h1 spread">
                    <h1>Your Hostel's Menu</h1>
                </div>
                <table class="questionTable">   
                    <hr>
                    <tr class="section_sub_title">
                        <td class="black-out"></td>
                        <td  class="black-out">BREAKFAST</td>
                        <td  class="black-out">LUNCH</td>
                        <td  class="black-out">SNACKS</td>
                        <td class="black-out">DINNER</td>
                    </tr>
                    <tr class="pad10">
                        <td><b>DAILY</b></td>
                        <td><?php echo $result['e1'];?></td>
                        <td><?php echo $result['e2'];?></td> 
                        <td><?php echo $result['e25'];?></td> 
                        <td><?php echo $result['e3'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>MONDAY</b></td>
                        <td><?php echo $result['e4'];?></td> 
                        <td><?php echo $result['e5'];?></td>
                        <td><?php echo $result['e26'];?></td>  
                        <td><?php echo $result['e6'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>TUESDAY</b></td>
                        <td><?php echo $result['e7'];?></td>
                        <td><?php echo $result['e8'];?></td>
                        <td><?php echo $result['e27'];?></td>  
                        <td><?php echo $result['e9'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>WEDNESDAY</b></td>
                        <td><?php echo $result['e10'];?></td>
                        <td><?php echo $result['e11'];?></td>
                        <td><?php echo $result['e28'];?></td>  
                        <td><?php echo $result['e12'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>THURSDAY</b></td>
                        <td><?php echo $result['e13'];?></td> 
                        <td><?php echo $result['e14'];?></td>
                        <td><?php echo $result['e29'];?></td>  
                        <td><?php echo $result['e15'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>FRIDAY</b></td>
                        <td><?php echo $result['e16'];?></td>
                        <td><?php echo $result['e17'];?></td>
                        <td><?php echo $result['e30'];?></td>  
                        <td><?php echo $result['e18'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>SATURDAY</b></td>
                        <td><?php echo $result['e19'];?></td> 
                        <td><?php echo $result['e20'];?></td>
                        <td><?php echo $result['e31'];?></td>  
                        <td><?php echo $result['e21'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>SUNDAY</b></td>
                        <td><?php echo $result['e22'];?></td>
                        <td><?php echo $result['e23'];?></td> 
                        <td><?php echo $result['e32'];?></td> 
                        <td><?php echo $result['e24'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="img-ctn-h1">
            <h1>Your Hostel's Mess Timings</h1>
        </div>
        <br>
        <div class="mess-time centery container circ">
            <table class="messtimeTable">
                <thead>
                        <tr class="firstRow">
                            <td class="black-out"></td>
                            <td class="black-out">BREAKFAST</td>
                            <td class="black-out">LUNCH</td>
                            <td class="black-out">SNACKS</td>
                            <td class="black-out">DINNER</td>
                        </tr>
                </thead>
                <tbody>
                    <tr class="pad10">
                        <td><b>FROM</b></td>
                        <td><?php echo $result['f1'];?></td>
                        <td><?php echo $result['f2'];?></td> 
                        <td><?php echo $result['f3'];?></td> 
                        <td><?php echo $result['f4'];?></td>
                    </tr>
                    <tr class="pad10">
                        <td><b>TO</b></td>
                        <td><?php echo $result['t1'];?></td>
                        <td><?php echo $result['t2'];?></td> 
                        <td><?php echo $result['t3'];?></td> 
                        <td><?php echo $result['t4'];?></td>
                    </tr>
                </tbody>    
            </table>
        </div>  
    </div>                     
    <?php 
        echo "  
        <div class='alert alert-success index-alert-upd' role='alert'>
            The menu was last updated on: ". $result['ldate']."
        </div><br>";
    ?> 
</body>
<script src="../assets/js/scripts.js"></script>