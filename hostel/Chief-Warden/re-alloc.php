<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

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
    
?>
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <div class="centerstage">
        <div class=" container infostage">
            <div class= initiate-file">
                <div class="feedback alloc-cont">
                   <form action="" method="POST">
                            
                            <div class="img-ctn-h1 spread">
                                  <h1>Reallocate Rooms</h1>
                            </div>
                            <br><br>
                            <div class="form-group">
                            
                            <label for="search">Enter Course Enrolled In</label>
                            <select name="course-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                            <option value="" hidden></option>
                              <?php
                            
                            $document = $collection->academics;
                            $find=$document->find(['role'=>'course']);  
    
                            
                            foreach($find as $as)
                            {
 
                                      echo "<option value='".$as['course']."'>".$as['course']."</option>";
                            }
                        ?>
                            
                            <option value="P">Phd Research Scholar</option>
                        </select>   </div>
                            <div class="form-group">

                        <label for="search">Enter Dept Enrolled In</label>
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
                    <label for="search">Enter Year to allocate</label>
                        <select name="year-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        <option value="1st">1</option>
                        <option value="2nd">2</option>
                        <option value="3rd">3</option>
                        <option value="4th">4</option>
                        <option value="5th">5</option>
                        <option value="6th">6</option>
                        <option value="7th">7</option>
                        <option value="8th">8+</option>
                    </select> 
                      </div>
                        <div class="form-group center-align">
                            <input type="submit" name="course" value="Submit Course Info" class="btn btn-primary img-ctn-btn">
                        </div>
                       <?php
                       if(isset($_POST['course'])){
                       $_SESSION['dept']=$_POST['dept-select'];
                       $_SESSION['course']=$_POST['course-select'];
                       $_SESSION['year']=$_POST['year-select'];
                       
                       header("location:reallocate.php");
                       }
                       ?>
                </form>
                </div></div></div></div>