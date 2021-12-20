<?php 
  
  session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password'])]);
    if(!$result){
        header("location:../index.php");
    }
    $name=strtoupper($result['name']);

   
?>

<body bgcolor="#FFFFCC" background="../assets/HAPPY%20BIRTHDAY%20NAME_files/image001.jpg"
lang=EN-US>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=EN-GB
style='font-size:48.0pt;line-height:100%;color:#5B9BD5'>HAPPY BIRTHDAY<br> </span></b><b><span
lang=EN-GB style='font-size:48.0pt;line-height:100%;color:green'><?php echo $name?></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><img width=310
height=300 id="Picture 1" src="../assets/HAPPY%20BIRTHDAY%20NAME_files/image002.png"
alt="Image result for happy birthday transparent background"></p>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=EN-GB
style='font-size:36.0pt;line-height:100%;color:red'>You have turned </span></b><b><i><span
lang=EN-GB style='font-size:48.0pt;line-height:100%;color:#FFD966'><?php echo $_SESSION['p_year']; ?>+</span></i></b><b><span
lang=EN-GB style='font-size:36.0pt;line-height:100%;color:#5B9BD5'> </span></b><b><span
lang=EN-GB style='font-size:36.0pt;line-height:100%;color:red'>now !!!!</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=EN-GB
style='font-size:24.0pt;line-height:100%;color:#5B9BD5'>WISH YOU A MANY-MANY </span></b><b><span
lang=EN-GB style='font-size:28.0pt;line-height:100%;color:#5B9BD5'>HAPPY
RETURNS </span></b><b><span lang=EN-GB style='font-size:24.0pt;line-height:
100%;color:#5B9BD5'>OF THE DAY!!</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=EN-GB
style='font-size:24.0pt;line-height:100%;color:#5B9BD5'>AND </span></b><b><span
lang=EN-GB style='font-size:24.0pt;line-height:100%;color:#0070C0'>A CHARMING
YEAR AHEAD</span></b><b><span lang=EN-GB style='font-size:24.0pt;line-height:
100%;color:#5B9BD5'>.</span></b></p>

</div>

</body>

</html>


</html>
