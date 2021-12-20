<?php 
  session_start();
  include('header.php'); 
  date_default_timezone_set("Asia/Kolkata");
?>
    <div class="container">
      <div class="row login_part">
        <div class="col-lg-12 col-md-12 col-sm-12 form_container">
          <form action="" method="post">
            <?php 

              require_once "vendor/autoload.php";
           

              if(isset($_POST['submit']))
              {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = md5($_POST['password']);

                $client = (new MongoDB\Client);
                $collection = $client->hostel;
                $document = $collection->users;
                if(array_key_exists("keepCookie", $_POST))
                {
                    if ($_POST['keepCookie'] == '1') 
               {

                            setcookie("username",$_POST['username'] ,time() + 365*60*60*24*7);
                            setcookie("password",$_POST['password'], time() + 365*60*60*24*7);
                

                        }
                      }
                $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
                $_SESSION['name'] = $result['name'];
                $_SESSION['time']= $result['last_login'];
                $updateResult = $document->updateOne(
                  ['username' => $_SESSION['username'], 'password' => $_SESSION['password']],
                  ['$set' => [
                      'last_login' =>date("d-m-Y   h:i A")
                  ]]        
              );

                if($result){
                  
                   $role = $result['role'];
                echo $role;
                     if($role === "Admin"){
                    header('location: Admin/dashboard.php');
                   } if($role === "Care Taker"){
                    header('location: Care-Taker/dashboard.php');
                   } if($role === "Assistant Warden"){
                    header('location: Assistant-Warden/dashboard.php');
                   } if($role === "Warden"){
                    header('location: warden/dashboard.php');
                   }
                   else
                  if($role === "Chief Warden"){
                    header('location: Chief-Warden/dashboard.php');
                   }
                   else
                  if($role === "student-council")
                  header('location: student-council/dashboard.php');
                 else     
                  if($role === "hr")
                  header('location: hr/dashboard.php');
                 else
                 if($role === "mr")
                  header('location: mr/dashboard.php');
                 else  
                  if($role == "Student")
                   header('location: student/dashboard.php');
                  else  if($role == "Security"){
                   header('location: security/dashboard.php');
                  }
                }
                else{
                  echo '<div class="alert alert-danger index-alert" role="alert">
                        Incorrect Username and Password!
                      </div>';
                }
              }
            ?>
            <div class="form-group">
              <label for="username">User Name</label>
              <input id="username" type="text" class="form-control" name="username"  value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"placeholder="Username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="checkbox" class="spec-2 height-inc" name="keepCookie" value="1">
              <label>Save Credentials</label>
            </div>
            <div class="full-screen">
              <button type="submit" class="btn btn-primary login-button" name="submit">Submit</button>              
            </div>
          </form><br>
          <a href="changepass.php">Forgot Password? Click Here</a><br>
          <a href="register.php">New Student? Register Here!</a><br>
          <a href="registerw.php">Admin Signup ? Click Here</a>
        </div>
      </div>
    </div>

<?php include('footer.php') ?>