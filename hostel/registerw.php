<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
?>  
    <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
      <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
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
                       </div>
                       <?php
                       if(isset($_POST['course'])){
                       $_SESSION['field']=$_POST['field-select'];
                       header("location:masterpass.php");
                       }
                       ?>
                </form>
                </div>
            </div>
        </div>
        </div>
		</body>