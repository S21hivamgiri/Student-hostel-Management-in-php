<?php
  session_start();
require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    //error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result1 = $document->findOne(['username' => $_SESSION['username'], 'password' =>md5( $_SESSION['password'])]);
if(!$result1){
    header("location:../index.php");
}

$year=date("Y");
$ar=date("y");
$cur_date=date("Y-m-d");
if(strtotime($cur_date)>=strtotime("10-06-".$year))

$semyear= $year.'-'.($ar+1);

else
$semyear= ($year-1).'-'.($ar);


$document = $collection->leave;
$res = $document->find(['roll_no' => $result1['roll_no']]);


?>





<body lang=EN-US style='tab-interval:36.0pt'>

<div class=WordSection1>
       <div class="img-ctn-h1">
                <h1>LEAVE STATUS</h1>
            </div>
            
            <br>



            <?php
foreach($res as $result)
{ 
if($result['course']=="B")$cour= "B.Tech"; else if($result['course']=="M")echo $cour="M.Tech"; else if($result['course']=="P")$cour= "PhD.";
if(strtotime($result['end'])<strtotime(date("d-m-Y")))
{
    $updateQuery = $document->updateOne(['l_id' => $result['l_id']], 
    ['$set' => ['comment' => "Journey Not Taken:-|",
                'journey'=>0]]);

}

if($result['w_verified']==0){$colorw="red";$w="No";}else {$colorw="#00B050";$w="Yes";}
if($result['sec_verified']==0){$colors="red";$s="No";}else {$colors="#00B050";$s="Yes";}


if(($result['journey']==-1||$result['journey']==0)&& strtotime($result['end'])>strtotime(date("d-m-Y")))

echo"
<div align=center>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:17.5pt;'>
 
  <td width=756 colspan=5 valign=top style='width:567.2pt;border:solid windowtext 1.0pt;;
  mso-border-top-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:17.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:16.0pt;mso-bidi-font-size:11.0pt'><b>".$result['l_id']."</id><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:17.5pt'>
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
  mso-bidi-font-size:11.0pt'>". $result['name']."<o:p></o:p></span></b></p>
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
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>".$cour."
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
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>".$result['roll_no']."<o:p></o:p></span></p>
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
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>".$result['year_study']."<o:p></o:p></span></p>
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
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>".$result['room_no'.$semyear]."<o:p></o:p></span></p>
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
  mso-bidi-font-size:11.0pt'>".$result['p_mobile']."<o:p></o:p></span></b></p>
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
  mso-bidi-font-size:11.0pt'>". $result['date_fill']."<o:p></o:p></span></i></p>
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
  ".$result['dura']."<o:p></o:p></span></p>
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
  ".$result['reason']."<o:p></o:p></span></p>
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
  ".$result['place']."<o:p></o:p></span></p>
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
  lumm=75000'>".date("d-M-Y",strtotime($result['start']))."<o:p></o:p></span></b></p>
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
  lumm=75000'>".$result['out_time']."<o:p></o:p></span></b></p>
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
  lumm=75000'>".date("d-M-Y",strtotime($result['end']))."<o:p></o:p></span></b></p>
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
  lumm=75000'>".$result['in_time']."<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:17.5pt'>
 <td width=756 colspan=5 valign=top style='width:567.2pt;border:none;
 mso-border-top-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
 background1;padding:0cm 5.4pt 0cm 5.4pt;height:17.5pt'>
 <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
 normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><b><center>".$result['comment']."</b></center><o:p></o:p></span></p>
 </td>
</tr>
 <tr style='mso-yfti-irow:12;height:17.5pt'>
  <td width=756 colspan=5 valign=top style='width:567.2pt;border:none;
  mso-border-top-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:17.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><o:p></o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:13'>
  <td width=236 valign=top style='width:176.9pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-right-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:#00B050'>Yes<o:p></o:p></span></b></p>
  </td>
  <td width=265 colspan=2 valign=top style='width:7.0cm;border:none;border-right:
  solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:".$colorw."'>".$w."</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
  11.0pt;color:#00B050'><o:p></o:p></span></b></p>
  </td>
  <td width=256 colspan=2 valign=top style='width:191.85pt;border:none;
  mso-border-left-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt;color:".$colors."'>".$s."</span></b><b
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
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>Student Verified<o:p></o:p></span></b></p>
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
  style='font-size:14.0pt;mso-bidi-font-size:11.0pt'>Security Verified<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:17.5pt'>
  <td width=756 colspan=5 valign=top style='width:567.2pt;border:none;
  mso-border-top-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:17.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt'><o:p></o:p></span></p>
  </td>
 </tr>

</table>

</div>
";

  }
?>


                    
 
</div>

</body>

</html>
