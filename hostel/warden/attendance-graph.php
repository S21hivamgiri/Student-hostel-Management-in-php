

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
<div class="section_sub_title">
            <h1> View Attendance Graphically</h1>
        </div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                <label for="floor">Floor No.<label><br>
                    <select id="floor" name="floor-select" class="floor-select-st">
                        <option value="" hidden default value="Floor Number"></option>
                        <option value="Ground">Ground Floor</option>
                        <option value="First">First Floor</option>
                        <option value="Second">Second Floor</option>
                        <option value="Third">Third Floor</option>
                        <option value="Fourth">Fourth Floor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center-col">
                <label for="hostel">Hostel<label><br>
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
                </div>

            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button-col">
                    <input type="submit" name="search-std" value="Search Student" class="btn btn-primary">
                </div>
            </div>

            </form >

            </body>

</html>

<?php
    if(isset($_POST['search-std']))
    {

   
    $_SESSION['floor-select']=$_POST['floor-select'];
  
    $_SESSION['hostel-select']=$_POST['hostel-select'];
    header("location:att-graph.php");
}
?>
