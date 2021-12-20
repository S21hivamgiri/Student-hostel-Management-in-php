<?php 
 session_start();
 require_once "../vendor/autoload.php";
 date_default_timezone_set("Asia/Kolkata");
 error_reporting(0);
 $year=date("Y");
    $ar=date("y");
    $cur_date=date("Y-m-d");
    if(strtotime($cur_date)>=strtotime("01-06-".$year))

    $semyear= $year.'-'.($ar+1);

    else
    $semyear= ($year-1).'-'.($ar);
 $client = (new MongoDB\Client);
 $collection = $client->hostel;
 $document = $collection->users;
 
 $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
 if(!$result){
     header("location:../index.php");
 }
    $rid = $result['wdn_id'];
    $ridname = $result['name'];
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>grievance Section</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
</head>
<body>
   
        <h1>Grievance List</h1>
        <div class='notice-board'>
            <?php 

                $client = (new MongoDB\Client);
                $collection = $client->hostel;
                $document = $collection->grievance;
                $result = $document->find([],['sort'=>['upload_date'=>-1]]);
                
                $wardname=$ridname;
                $wardenid=$rid;

                foreach($result as $res){
                    $grievance_header = $res['grievance_header'];
                    $grievance_content = $res['grievance_content'];
                    $update = $res['upload_date'];
                    $grievance_id = $res['grievance_id'];
                    $grievance_name = $res['name'];
                    $room=$res['room_no'.$semyear];
                    $roll = $res['roll_no'];
                   $phone=$res['p_mobile'];
                    echo "
                   
                    <div class='cp-div pwd-wide'>
                    <form action='grie-submit.php?regno=".$roll."&giveno=".$grievance_id."&rid=".$rid."&ridname=".$ridname."' method='post'>   
                       ";
                       
                       if($res['status']=='Submitted')
                            $rest= " <input type='submit' class='btn btn-success img-ctn-btn' name='update-grievance' value='Acknowledge'>";
                    else $rest="Grievance Acknowledged";
                            
                            
           echo"                 
                            
<div align=center>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=160 valign=top style='width:120.25pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  background:black;mso-background-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><b style='mso-bidi-font-weight:normal'><span
  lang=EN-GB style='color:white;mso-ansi-language:EN-GB'>".$res['grievance_id']."</span></b></span><b
  style='mso-bidi-font-weight:normal'><span lang=EN-GB style='color:windowtext;
  mso-ansi-language:EN-GB'><o:p></o:p></span></b></p>
  </td>
  <td width=142 valign=top style='width:106.3pt;border:none;border-bottom:solid windowtext 1.0pt; background:black;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-GB style='mso-ansi-language:EN-GB'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=274 valign=top style='width:205.55pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  background:black;mso-background-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span class=SpellE><b style='mso-bidi-font-weight:
  normal'><span lang=EN-GB style='color:white;mso-ansi-language:EN-GB'>".$res['upload_date']."</span></b></span><b
  style='mso-bidi-font-weight:normal'><span lang=EN-GB style='color:windowtext;
  mso-ansi-language:EN-GB'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=576 colspan=3 valign=top style='width:432.1pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  background:#FFF2CC;mso-background-themecolor:accent4;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  lang=EN-GB style='mso-ansi-language:EN-GB'>".$res['grievance_header']."<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=576 colspan=3 valign=top style='width:432.1pt;border:none;
  mso-border-top-alt:solid windowtext .5pt;background:#FFF2CC;mso-background-themecolor:
  accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-GB style='mso-ansi-language:EN-GB'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:35.55pt'>
  <td width=576 colspan=3 valign=top style='width:432.1pt;background:#FFF2CC;
  mso-background-themecolor:accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;
  height:35.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-GB style='color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000;mso-ansi-language:EN-GB'>".$res['grievance_content']."<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=576 colspan=3 valign=top style='width:432.1pt;background:#FFF2CC;
  mso-background-themecolor:accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-GB style='color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000;mso-ansi-language:EN-GB'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=576 colspan=3 valign=top style='width:432.1pt;background:#FFF2CC;
  mso-background-themecolor:accent4;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-GB style='color:#7F7F7F;mso-themecolor:background1;
  mso-themeshade:128;mso-style-textfill-fill-color:#7F7F7F;mso-style-textfill-fill-themecolor:
  background1;mso-style-textfill-fill-alpha:100.0%;mso-style-textfill-fill-colortransforms:
  lumm=50000;mso-ansi-language:EN-GB'>".$res['p_mobile']."<o:p></o:p></span></p>
  </td>
  <tr style='mso-yfti-irow:6'>
  <td width=160 rowspan=2 valign=top style='width:120.25pt;background:black;
  mso-background-themecolor:accent6;mso-background-themetint:102;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><span lang=EN-GB
  style='font-size:14.0pt;mso-bidi-font-size:15.0pt;color:#00B050;mso-ansi-language:
  EN-GB'>".$rest."<o:p></o:p></span></p>
  </td>
  <td width=416 colspan=2 valign=top style='width:11.0cm;background:#0D0D0D;
  mso-background-themecolor:text1;mso-background-themetint:242;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
  normal'><span lang=EN-GB style='color:white;mso-ansi-language:EN-GB'>".$res['roll_no']."<o:p></o:p></span></i></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;mso-yfti-lastrow:yes'>
  <td width=416 colspan=2 valign=top style='width:11.0cm;background:#0D0D0D;
  mso-background-themecolor:text1;mso-background-themetint:242;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
  normal'><span lang=EN-GB style='color:white;mso-ansi-language:EN-GB'>".$phone."<o:p></o:p></span></i></b></p>
  </td>
 </tr>
</table>

</div>

<p><span lang=EN-GB style='font-size:24pt;mso-ansi-language:EN-GB'><o:p>&nbsp;</o:p></span></p>

                            
                            
                            
                            
                            ";
                    echo "</form>
                    </div>
                    </div>
                    ";
                }
                
            ?>
        </div>
         

   
</body>
</html>