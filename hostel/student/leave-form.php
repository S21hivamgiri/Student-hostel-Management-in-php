<?php
  session_start();
require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result = $document->findOne(['username' => $_SESSION['username'], 'password' => md5($_SESSION['password'])]);
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






$t =strtotime($result['doj']);
$cur_date=date("Y-m-d");
$j_year=date("Y",$t);
$ti=strtotime("10-06-".$j_year);
$r=strtotime($cur_date);
$diff=$r-$ti;
$year=$diff/(365*60*24*60);
$i=(int) $year+1;
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($i %100) >= 11 && ($i%100) <= 13)
   $abbreviation = 'th';
else
   $abbreviation = $ends[$i % 10];
  $stuyear=$i.$abbreviation;


  
  
   if( $result['room_no'.$semyear])
   $room= $result['room_no'.$semyear];
   else{

    $room= "<b>Room not Allocated</b>";
   }
?>


 <head>
   <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
 </head>



<body lang=EN-US style='tab-interval:36.0pt'>

<div class=WordSection1>

<form action="" method="post" >
            <div class="img-ctn-h1" style='background: #022f5f !important;color: white;width: max-content;padding: 1em;margin: 0px auto;text-transform: uppercase;border-radius: 4px;font-family: "Roboto", sans-serif;'>
                <h1 style='font-size: 1.1rem !important;text-align: center;font-weight: 100;margin: 0px auto;width: max-content;'>LEAVE FORM</h1>
            </div>
            
            
<div align=center>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#FBE4D5;mso-background-themecolor:
  accent2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Name of Applicant<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt'><?php echo $result['name'];?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Course<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><?php echo $result['course'];?>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Roll. No.<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><?php echo $result['roll_no']?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Year<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><?php if($result['stuyear'])echo $result['stuyear']; else echo $stuyear ?><o:p></o:p></span></p>
  </td> 
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Room No.<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><?php echo $room ?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Mobile No.<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt'><?php echo $result['p_mobile']?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Date of filling the form<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><i style='mso-bidi-font-style:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt'><?php echo date("d-m-Y");?><o:p></o:p></span></i></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>No. of Days Leave<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>
  <input type="number" style="background:#D5DCE4;width:325.3pt;11.0pt" name="numday" min="1" max="100" placeholder="Enter number of days" required><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Purpose of leave<o:p></o:p></span></b></p>
 
</td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'> 
  <input type="text" style="background:#D5DCE4;width:325.3pt;font-size:11.0pt" name="numreason"  placeholder="Enter Reason of leave" required><o:p></o:p></span></p>
   </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=236 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Places of Visit with full address<o:p></o:p></span></b></p>
  </td>
  <td width=520 colspan=4 valign=top style='width:390.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>
  <textarea style="background:#D5DCE4;font-size:11.0pt;width:325.3pt;height:60pt;" name="numplace"  placeholder="Enter Place of Visit" Required></textarea><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=236 rowspan=2 valign=top style='width:176.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FBE4D5;mso-background-themecolor:accent2;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;
  mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000'>Travel Plan<o:p></o:p></span></b></p>
  </td>
  <td width=104 valign=top style='width:77.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#FFF2CC;mso-background-themecolor:
  accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:
  background1;mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;
  mso-style-textfill-fill-themecolor:background1;mso-style-textfill-fill-alpha:
  100.0%;mso-style-textfill-fill-colortransforms:lumm=50000'>Out Date<o:p></o:p></span></b></p>
  </td>
  <td width=161 valign=top style='width:120.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#FFF2CC;mso-background-themecolor:
  accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:
  background1;mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;
  mso-style-textfill-fill-themecolor:background1;mso-style-textfill-fill-alpha:
  100.0%;mso-style-textfill-fill-colortransforms:lumm=50000'>Out Time<o:p></o:p></span></b></p>
  </td>
  <td width=123 valign=top style='width:92.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#FFF2CC;mso-background-themecolor:
  accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:
  background1;mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;
  mso-style-textfill-fill-themecolor:background1;mso-style-textfill-fill-alpha:
  100.0%;mso-style-textfill-fill-colortransforms:lumm=50000'>Return Date<o:p></o:p></span></b></p>
  </td>
  <td width=133 valign=top style='width:99.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#FFF2CC;mso-background-themecolor:
  accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#7F7F7F;mso-themecolor:
  background1;mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;
  mso-style-textfill-fill-themecolor:background1;mso-style-textfill-fill-alpha:
  100.0%;mso-style-textfill-fill-colortransforms:lumm=50000'>Return Time<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=104 valign=top style='width:77.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#2E75B6;mso-themecolor:
  accent5;mso-themeshade:191;mso-style-textfill-fill-color:#2E75B6;mso-style-textfill-fill-themecolor:
  accent5;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=75000'><input type="date" style="background:#D5DCE4;" name="numdate"  value="<?php echo date("Y-m-d");?>"><o:p></o:p></span></b></p>
  </td>
  <td width=161 valign=top style='width:120.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#2E75B6;mso-themecolor:
  accent5;mso-themeshade:191;mso-style-textfill-fill-color:#2E75B6;mso-style-textfill-fill-themecolor:
  accent5;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=75000'>At Exit from Hostel<o:p></o:p></span></b></p>
  </td>
  <td width=123 valign=top style='width:92.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#2E75B6;mso-themecolor:
  accent5;mso-themeshade:191;mso-style-textfill-fill-color:#2E75B6;mso-style-textfill-fill-themecolor:
  accent5;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=75000'><o:p></o:p></span></b></p>
  </td>
  <td width=133 valign=top style='width:99.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D5DCE4;mso-background-themecolor:
  text2;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#2E75B6;mso-themecolor:
  accent5;mso-themeshade:191;mso-style-textfill-fill-color:#2E75B6;mso-style-textfill-fill-themecolor:
  accent5;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=75000'>At time of Return<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:17.5pt'>
  <td width=756 colspan=5 valign=top style='width:567.2pt;border:none;
  mso-border-top-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:17.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=236 valign=top style='width:176.9pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-right-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:red'>No<o:p></o:p></span></b></p>
  </td>
  <td width=265 colspan=2 valign=top style='width:7.0cm;border:none;border-right:
  solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:red'>No</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
  11.0pt;color:#00B050'><o:p></o:p></span></b></p>
  </td>
  <td width=256 colspan=2 valign=top style='width:191.85pt;border:none;
  mso-border-left-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:red'>No</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;mso-yfti-lastrow:yes'>
  <td width=236 valign=top style='width:176.9pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-right-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>Student Verified (at Submission)<o:p></o:p></span></b></p>
  </td>
  <td width=265 colspan=2 valign=top style='width:7.0cm;border:none;border-right:
  solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>Warden Verified<o:p></o:p></span></b></p>
  </td>
  <td width=256 colspan=2 valign=top style='width:191.85pt;border:none;
  mso-border-left-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>Security Verified (at time of Exit)<o:p></o:p></span></b></p>
  </td>
 </tr>
</table>



</div>
<center>
     <input type="submit" name="leaveform" value="Submit Info" class="btn btn-primary img-ctn-btn">
</center>
                    
  </form>
</div>

</body>

</html>
<?php
if(isset($_POST["leaveform"]))
{

  $client = (new MongoDB\Client);
  $collection = $client->hostel;
  $document = $collection->leave;
$count=$document->count();

$id=str_pad($count+1, 7, '0', STR_PAD_LEFT);
$l_id="LEV".$id;
$time=date("h-i-s a");
$t =strtotime($_POST['numdate']);
$end = strtotime('+'.$_POST['numday'].' days', $t);

$ret=date("Y-m-d",$end);

$insert=$document->insertOne(
  [
    "l_id"=>$l_id,
    "end"=>$ret,
    "start"=>$_POST['numdate'],
    "dura"=>$_POST['numday'],
    "reason"=>$_POST['numreason'],
    "place"=>$_POST['numplace'],
    "time_posted"=>$time,
    "semyear"=>$semyear,
    "year_study"=>$i.$abbreviation,
    "stu_verified"=>1,
    "w_verified"=>0,
    "sec_verified"=>0,
    "name"=>$result['name'],
    "date_fill"=> date("d-m-Y"),
    "room_no".$semyear=>$result['room_no'.$semyear],
    "hostelno".$semyear=>$result['hostelno'.$semyear],
    "course"=>$result['course'],
    "p_mobile"=>$result['p_mobile'],
    "roll_no"=>$result['roll_no'],
    'comment'=>"",
    'out_time'=>"filled At Exit",
    'in_time'=>"filled at Return",
    "journey"=>-1,
    'grant'=>0
  ]
);
 if($insert)
{
echo "  <div class='alert alert-success index-alert-upd' role='alert'>
The Leave appication Number: <b>". $l_id."is successfully drafted for warden verification</b>
</div>";
}
}

?>