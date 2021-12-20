<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
?>  
    <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
      <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
	</head>
	<body>
    <div class="centerstage">
        <div class="infostage">
            <div class="container initiate-file overwrite">
                <div class="feedback">
                   <form action="" method="POST">
                            
                            <div class="section_title spread">
                            <h1>Designation Information</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            
                            <label for="search">Enter your designation</label><br>
                            <select name="field-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                            <option value="" hidden></option>
                            <option value="Warden">Warden</option>
                            <option value="Chief Warden">Chief Warden</option>
                            <option value="Assitant Warden">Assistant Warden</option>
                            <option value="Care Taker">Care Taker</option>
                            <option value="Security">Security</option>
                            
                            </select>   
                            </div>

                      
                      
                        <div class="form-group">
                       
                        <input type="submit" name="course" value="Submit Course Info" class="btn btn-primary img-ctn-btn">
                           </form>
                       </div>
                       <?php

                             $client = (new MongoDB\Client);
      $collection = $client->hostel;
      $document = $collection->mast;           
      $findResult = $document->findOne([ 'mast_id'=>$_SESSION['field']] );

                         if(isset($_POST['updatePwd'])){
                    if($_POST['newPassword'] !== $_POST['confirmPassword']){
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Passwords don't match!
                            </div>";
                    } else if($_POST['prePassword'] !==  $findResult['master_password']){
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Present password is wrong if forgot logout and Forget Password
                            </div>";
                    } 
                    else if($_POST['newPassword'] === $_POST['confirmPassword']){
                        $new_Password = $_POST['newPassword'];
                        $updateQuery = $document->updateOne(['mast_id'=>$_SESSION['field']], 
                        ['$set' => ['password' => $new_Password]]);


                          echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                    The master-password of ".$_SESSION['field'] ." has been successfully updated</b>
                </div>";
                       
                    }
                }











                       if(isset($_POST['course'])){
                       $_SESSION['field']=$_POST['field-select'];
        echo '<div class="cp-div pwd-wide">
        <form action="" method="post">
        
           <div class="img-ctn-h1">
                <h1>Update Password</h1>
            </div>
            <br>
            <div class="form-group">
                <label for="registrationNo">Enter Present Password</label>
                <input type="password" class="form-control" name="prePassword" placeholder="Enter Present Password" required>
            </div>
            <div class="form-group">
                <label for="newPassword">Enter New Password</label>
                <input type="password" class="form-control" name="newPassword" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <input type="submit" class="btn btn-primary img-ctn-btn" name="updatePwd" value="Submit">
        </form>
    </div>';
               
               
               
                    }
                       ?>
             
                </div>
            </div>
        </div>
        </div>
		</body>