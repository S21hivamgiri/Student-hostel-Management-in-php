<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
  
    
  if(isset($_POST['wardinfo']))
  {

      $find=$document->findOne(['role'=>'Security','hostelno'=>$_POST['hostel-select']]);  
             if(!$find){       
                if($_POST['cpass']==$_POST['pass'])
                {   
            
                  $i=$document->count(['role'=>'Security']);  
                    

                        $_SESSION['hostel'] = $_POST['hostel-select'];
                        $_SESSION['username']= "SECURITY".$i;
                
                $insertdata=$document->insertOne([
                    'name' => $_POST['hostel-select'],
                    'password'=>md5($_POST['pass']),
                    'username'=> "SECURITY".$i,
                    'sec_id'=> "SECURITY".$i,
                   'role'=>"Security",
                   'last_login'=>'',
                    "hostelno"=>$_POST['hostel-select']
                    
               ]);
          header("location:newpasss.php");

                     
                }        
                
         
            else echo "<div class='alert alert-danger index-alert-upd' role='alert'>Password did not match</div>";  
            }
            else echo "<div class='alert alert-danger index-alert-upd' role='alert'>Account already Exist</div>";
  }

                                    
?>  
    <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
      <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
	</head>
	<body>
    <div class="centerstage row">
        <div class="infostage">
            <div class="container initiate-file">
                <div class="feedback">
                   <form action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="section_title spread">
                                  <h1>General information</h1>
                            </div>
           
<div class="form-group center-align">
    <label for="search">Select Hostel</label>
    <select name="hostel-select" style=" border-radius:4px;" class="floor-select-st shift-up">
        <option value="" hidden selected="selected"></option>
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
<div class="section_title spread">
    <h1>Password Section</h1>
</div>
                            <div class="form-group center-align">
                            <label>Enter Password</label><br>
                            <input type="password" class="form-control spec-3" name="pass" placeholder="Enter Password" required>
                            </div>
              
                            <div class="form-group center-align">
                            <label>Confirm Password</label><br>
                            <input type="password" class="form-control spec-3" name="cpass" placeholder="Confirm Password" required>
                            </div>
                         

            <div class="center-align">
                            <input type="submit" name="wardinfo" value="Submit Info" class="btn btn-primary img-ctn-btn">
                   </div>
                    
           </form>
           </div>   
           </div>
           </div>
		   </div>
		   </body>