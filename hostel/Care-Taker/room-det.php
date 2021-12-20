

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
    <form action="" method="post">
        <br><br>

        <div class="border">
            <div class="img-ctn-h1">
                <h1> View Room Information</h1>
            </div>
            <br>
            <label for="search">Enter Room Number</label>
            <select name="floor-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                <option value="" hidden></option>
                <option value="G">G</option>
                <option value="F">F</option>
                <option value="S">S</option>
                <option value="T">T</option>
                <option value="R">R</option>
            </select>           
            <input type="number" class="form-control spec-4" min="1" max="43" name="roomNo" placeholder="Enter Room Number"required>
            
            <br><label for="hostel">Hostel</label>
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
        </div>

        </div>
    </form >
</body>

</html>

<?php
    if(isset($_POST['search-std']))
    {

        $room= $_POST['floor-select'].$_POST['roomNo'];
  
   
    header("location: room-info.php?room=".$room."&hostel=".$_POST['hostel-select']);
}
?>
