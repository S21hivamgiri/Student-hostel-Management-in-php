<?php 
  
  session_start();
    require_once "./vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;
    error_reporting(0);

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' =>($_SESSION['password'])]);
    if(!$result){
        header("location:../index.php");
    }
    $name=$result['name'];
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($_SESSION['r_year'] %100) >= 11 && ($_SESSION['r_year']%100) <= 13)
   $abbreviation = 'th';
else
   $abbreviation = $ends[$_SESSION['r_year'] % 10];
   
?>



<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  background-image: url("./assets/img/flag.jpg");


  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.icon-ashoka-chakra {
    content: url(https://upload.wikimedia.org/wikipedia/commons/1/17/Ashoka_Chakra.svg);
    height: 165px;
  }
  
  
  .flag.india i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 124px;
    line-height: 0.65;
    z-index: 10;
  }
</style>
<link rel=File-List
href="./assets/Feel%20Proud%20to%20be%20an%20Indian_files/filelist.xml">
<link rel=themeData
href="./assets/Feel%20Proud%20to%20be%20an%20Indian_files/themedata.thmx">
<link rel=colorSchemeMapping
href="./assets/Feel%20Proud%20to%20be%20an%20Indian_files/colorschememapping.xml">



<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    
       
</head>

<body class="bg" lang=EN-US style='tab-interval:36.0pt'>



  <div class="flags">
			<div class="flag india">
		<i class="icon-ashoka-chakra"></i>
	</div>  

    <div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-GB style='font-size:72.0pt;mso-bidi-font-size:11.0pt;
line-height:106%;mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;
color:#F8CBAD;mso-themecolor:accent2;mso-themetint:102;mso-style-textfill-fill-color:
#F8CBAD;mso-style-textfill-fill-themecolor:accent2;mso-style-textfill-fill-alpha:
100.0%;mso-style-textfill-fill-colortransforms:"lumm=40000 lumo=60000";
mso-style-textoutline-type:solid;mso-style-textoutline-fill-color:#ED7D31;
mso-style-textoutline-fill-themecolor:accent2;mso-style-textoutline-fill-alpha:
100.0%;mso-style-textoutline-outlinestyle-dpiwidth:.52pt;mso-style-textoutline-outlinestyle-linecap:
flat;mso-style-textoutline-outlinestyle-join:round;mso-style-textoutline-outlinestyle-pctmiterlimit:
0%;mso-style-textoutline-outlinestyle-dash:solid;mso-style-textoutline-outlinestyle-align:
center;mso-style-textoutline-outlinestyle-compound:simple;mso-effects-shadow-color:
#ED7D31;mso-effects-shadow-themecolor:accent2;mso-effects-shadow-alpha:100.0%;
mso-effects-shadow-dpiradius:0pt;mso-effects-shadow-dpidistance:3.0pt;
mso-effects-shadow-angledirection:2700000;mso-effects-shadow-align:topleft;
mso-effects-shadow-pctsx:100.0%;mso-effects-shadow-pctsy:100.0%;mso-effects-shadow-anglekx:
0;mso-effects-shadow-angleky:0;mso-ansi-language:EN-GB'>Feel Proud to be an
Indian<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-GB
style='font-size:72.0pt;mso-bidi-font-size:11.0pt;line-height:106%;mso-ansi-language:
EN-GB'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-GB
style='font-size:72.0pt;mso-bidi-font-size:11.0pt;line-height:106%;mso-ansi-language:
EN-GB'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-GB
style='font-size:72.0pt;mso-bidi-font-size:11.0pt;line-height:106%;mso-ansi-language:
EN-GB'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-GB
style='font-size:60.0pt;mso-bidi-font-size:11.0pt;line-height:106%;mso-ansi-language:
EN-GB'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-GB
style='font-size:48.0pt;mso-bidi-font-size:11.0pt;line-height:106%;font-family:
"Denka",sans-serif;color:#C5E0B4;mso-ansi-language:EN-GB'>HAPPY </span><span
lang=EN-GB style='font-size:80.0pt;mso-bidi-font-size:11.0pt;line-height:106%;
font-family:"Roboto Black";color:white;mso-themecolor:background1;mso-ansi-language:
EN-GB'><?php echo $_SESSION['r_year'].$abbreviation.' ';?></span><span lang=EN-GB style='font-size:48.0pt;mso-bidi-font-size:
11.0pt;line-height:106%;font-family:"Denka",sans-serif;color:#C5E0B4;
mso-ansi-language:EN-GB'> REPUBLIC DAY</span><span lang=EN-GB
style='font-size:72.0pt;mso-bidi-font-size:11.0pt;line-height:106%;color:#C5E0B4;
mso-ansi-language:EN-GB'><o:p></o:p></span></p>

</div>

</body>
</html>
