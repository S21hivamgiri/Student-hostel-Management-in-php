<?php 
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
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
            <div class="container initiate-file">
                <div class="feedback">
                   <form action="" method="POST">
                            
                            <div class="section_title spread">
                                  <h1>Course Information</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            
                            <label for="search">Enter Course Enrolled In</label><br>
                            <select name="course-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                            <option value="" hidden></option>
                            <?php
                            
                            $document = $collection->academics;
                            $find=$document->find(['role'=>'course'],['sort'=>['course'=>1]]);  
    
                            
                            foreach($find as $as)
                            {
 
                                      echo "<option value='".$as['course']."'>".$as['course']."</option>";
                            }
                        ?>
                            </select>   </div>
                            <div class="form-group">

                        <label for="search">Enter Dept Enrolled In</label><br>
                        <select name="dept-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                           <?php
                            
                            $document = $collection->academics;
                            $find=$document->find(['role'=>'dept'],['sort'=>['dept'=>1]]);  
    
                            
                            foreach($find as $as)
                            {
 
                                      echo "<option value='".$as['dept']."'>".$as['dept']."</option>";
                            }
                        ?>
                            
                    </select>   </div>
                   
                      
                      
                      
                        <div class="form-group">
                       
                        <input type="submit" name="course" value="Submit Course Info" class="btn btn-primary img-ctn-btn">
                       </div>
                       <?php
                       if(isset($_POST['course'])){
                       $_SESSION['dept']=$_POST['dept-select'];
                       $_SESSION['course']=$_POST['course-select'];
                       
                       header("location:register2.php");
                       }
                       ?>
                </form>
                </div></div></div></div>
				</body>