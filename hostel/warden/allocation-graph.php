

<?php session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password'],'role'=>"Warden"]);
    if(!$result)
    {
        header("location:../index.php");
    }
    
?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- <script src="../assets/js/google/recaptcha/api.js" async defer></script> -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

    <body lang=EN-US style='tab-interval:36.0pt'>
    <div class="alloc-cont border-2">
        <form action="" method="post">
            <div class="img-ctn-h1">
                <h1> View Allocation Graphically</h1>
            </div>
            <br>
            <label for="floor">Floor No.</label>
            <select id="floor" name="floor-select" class="floor-select-st">
                <option value="" hidden default value="Floor Number"></option>
                <option value="Ground">Ground Floor</option>
                <option value="First">First Floor</option>
                <option value="Second">Second Floor</option>
                <option value="Third">Third Floor</option>
                <option value="Fourth">Fourth Floor</option>
            </select>
            <br>
            <label for="hostel">Hostel</label>
            <select id="hostel" name="hostel-select" class="floor-select-st" placeholder="Hostel">
                <?php
 $document = $collection->academics;
  $find=$document->find(['role'=>'hostel']);  
    
    
        foreach($find as $as)
        {
        echo "<option value='".$as['hostel']."'>".$as['hostel']."</option>";
        }
        ?>
            </select>
            <div class="form-group center-align">
                <input type="submit" name="search-std" value="Search Student" class="btn btn-primary img-ctn-btn">
            </div>  
        </form >
    </div>

    </body>

</html>

<?php
    if(isset($_POST['search-std']))
    {

   
    $_SESSION['floor-select']=$_POST['floor-select'];
  
    $_SESSION['hostel-select']=$_POST['hostel-select'];
    header("location:graph.php");
}
?>
