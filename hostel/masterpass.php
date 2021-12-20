<?php
    session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);
    
      $role=$_SESSION['field'];
    echo '
      <form action="" method="POST" class="form-edit">
        <div class="form-group">
          <label for="search">Enter Administrative Master Password for '.$role.' </label><br>
          <input id="password" type="password" class="form-control" name="password"  placeholder="Master Password">
          <input type="submit" name="rumm" value="Proceed to registration" class="btn btn-primary img-ctn-btn">
          <input type="submit" name="numm" value="Cancel" class="btn btn-primary img-ctn-btn">
        </div>
      </form>
    ';
    if(isset($_POST['numm']))
      header("location:./index.php");
    if(isset($_POST['rumm']))
    {
          
      $client = (new MongoDB\Client);
      $collection = $client->hostel;
      $document = $collection->mast;           
      $findResult = $document->findOne([ 'mast_id'=>$_SESSION['field']] );
  
      if($_POST['password']=== $findResult['master_password']) 
      {  
        if($_SESSION['field']=="Security")
          header("location:registersec.php");
        else 
          header("location:register-warden.php");
      }
      else 
      {
        echo '
          <div class="centerstage row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 infostage">
                <div class="initiate-file if">
                    <div class="alert alert-danger" role="alert">
                        <br>
                          <p>Sorry!!
                          Password is Incorrect!!<br>
                          Contact the Admin for Administrative Password.</p>
                    </div>
                </div>
            </div>
        </div>';
      }
    }            
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">3
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>