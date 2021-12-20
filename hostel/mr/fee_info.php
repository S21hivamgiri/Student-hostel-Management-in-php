<?php

 session_start();
 $roll = htmlspecialchars($_GET['regno']);

    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <title></title>
</head>
	<body>

  <?php  
    $result = $document->findOne(['roll_no'=>$roll]);
    $array=(array)$result;
    $key=(array)(array_keys($array));
$a=array();
$count=sizeof($array);
for($i=0;$i<$count;$i++)
{
   
if (preg_match("/[\s]*(hostelno)/i", $key[$i]))
{

array_push($a,substr($key[$i],8,7));

}
}
echo "<h1>Allocation Information</h1>";
echo"<br><br><table><tr>
<td>Year</td>
<td>Room</td>
<td>Floor</td>
<td>Hostel</td>
</tr>";
$count=sizeof($a);
if($count==0)
{

echo "<div class='alert alert-danger' role='alert'>
Not allocated till Now or Deallocated from hostel
</div>";
}
    else
for($i=0;$i<$count;$i++)
{
echo"<tr>
<td>".$a[$i]."</td>

<td>".$result['room_no'.$a[$i]]."</td>
<td>".$result['floorno'.$a[$i]]."</td>
<td>".$result['hostelno'.$a[$i]]."</td>
</tr>";
}
?>
</body>
</html>