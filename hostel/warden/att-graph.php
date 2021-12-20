<?php 
  session_start();
    
  require_once "../vendor/autoload.php";
  date_default_timezone_set("Asia/Kolkata");
  //error_reporting(0);
  $year=date("Y");
  $ar=date("y");
  $cur_date=date("Y-m-d");
  if(strtotime($cur_date)>=strtotime("10-06-".$year))
  
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


  $f=$_SESSION['floor-select'];
       if($_SESSION['floor-select']=='Ground')$floor="G";
  else if($_SESSION['floor-select']=='First')$floor="F";
  else if($_SESSION['floor-select']=='Second')$floor="S";
  else if($_SESSION['floor-select']=='Third')$floor="T";
  else if($_SESSION['floor-select']=='Fourth')$floor="R";
  $hostel=$_SESSION['hostel-select'];
  echo"<h4>Floor: </h4><p>".$f." floor</p><h4>  Hostel: </h4><p>".$hostel."</p>";
  for($i=1;$i<=43;$i++)
  { 
    $document = $collection->leave;
      $leavecount[$i]=$document->count(['room_no' =>$floor.$i,'hostelno'=>$hostel,'journey'=>1 ]);
        $document = $collection->register;
      $iocount[$i]=$document->count(['room' =>$floor.$i,'hostel'=>$hostel,'role'=>'In/Out','journey'=>"1" ]);   
    $document = $collection->users;
      $count[$i]=$document->count(['room_no'.$semyear =>$floor.$i,'hostelno'.$semyear=>$hostel ]);
      $present[$i]=$count[$i]- $leavecount[$i];
      $document = $collection->room;
      $findres=$document->findOne(['room_no'.$semyear =>$floor.$i,'hostelno'.$semyear=>$hostel ]);
      if($findres['status']==-1)
      $color[$i]="pink";else
      if($findres['status']==-2)
      $color[$i]="black";else
      if($count[$i]>2)
      $color[$i]="#ffcfbc";
      else if($count[$i]==2)
      $color[$i]="#b5ffc5";
      else if($count[$i]==1)
      $color[$i]="yellow";
      else if($count[$i]==0)
      $color[$i]="#D9E2F3";
  }
 
?>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    
<div class=WordSection1>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 align=left
 width="98%" style='position: relative; width:98%;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;mso-table-lspace:
 9.0pt;margin-left:6.75pt;mso-table-rspace:9.0pt;margin-right:6.75pt;
 mso-table-anchor-vertical:margin;mso-table-anchor-horizontal:margin;
 mso-table-left:left;mso-table-top:30.6pt;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:27.15pt'>
  <td width=118 colspan=2 rowspan=2 valign=top style='width:88.85pt;border:
  solid windowtext 1.0pt;mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=84 valign=top style='width:62.65pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:<?php echo $color[25]?>;mso-background-themecolor:accent1;
  mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'> <?php $num=25;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[25]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[25]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[25].'</span>/'.$count[25]."</sub></p>";?>
  </td>
  <td width=81 rowspan=3 valign=top style='width:60.7pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:white;mso-background-themecolor:background1;
  padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=237 colspan=4 rowspan=2 valign=top style='width:178.0pt;border:
  solid windowtext 1.0pt;border-left:none;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=150 colspan=2 valign=top style='width:112.75pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;
  background:#d291ea;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Mess</p>
  </td>
  <td width=301 colspan=4 rowspan=2 valign=top style='width:225.95pt;
  border:solid windowtext 1.0pt;border-left:none;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 rowspan=3 valign=top style='width:50.7pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:white;mso-background-themecolor:background1;
  padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;background:<?php echo $color[15]?>;mso-background-themecolor:accent1;
  mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=15;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[15]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[15]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[15].'</span>/'.$count[15]."</sub></p>";?>
  </td>

  <td width=119 colspan=2 rowspan=2 valign=top style='width:89.3pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
</tr>

<tr style='mso-yfti-irow:1;height:27.15pt'>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[26]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=26;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[26]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[26]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
  href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[26].'</span>/'.$count[26]."</sub></p>";?>
   </td>
  <td width=150 colspan=2 rowspan=2 valign=top style='width:112.75pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Common-room</p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[16]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=16;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[16]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[16]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[16].'</span>/'.$count[16]."</sub></p>";?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:27.15pt'>
  <td width=59 valign=top style='width:44.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:<?php echo $color[27]?>;mso-background-themecolor:accent1;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>
<?php $num=27;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[27]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[27]."</b></span></sup>
  <a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."
   </a><sub><b><span style='color:#0037ff'>".$present[27].'</span>/'.$count[27]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[28]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>
  <?php $num=28;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[28]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[28]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[28].'</span>/'.$count[28]."</sub></p>";?>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D0CECE;mso-background-themecolor:
  background2;mso-background-themeshade:230;padding:0cm 5.4pt 0cm 5.4pt;
  height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Stairs</p>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[24]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=24;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[24]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[24]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[24].'</span>/'.$count[24]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[23]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=23;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[23]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[23]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[23].'</span>/'.$count[23]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[22]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=22;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[22]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[22]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[22].'</span>/'.$count[22]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[21]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=21;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[21]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[21]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[21].'</span>/'.$count[21]."</sub></p>";?>
  </td>
  <td width=123 valign=top style='width:92.2pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[20]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=20;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[20]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[20]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[20].'</span>/'.$count[20]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[19]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=19;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[19]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[19]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[19].'</span>/'.$count[19]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[18]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=18;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[18]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[18]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[18].'</span>/'.$count[18]."</sub></p>";?>
  </td>
  <td width=60 valign=top style='width:44.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[17]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>
 <?php $num=17;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[17]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[17]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[17].'</span>/'.$count[17]."</sub></p>";?>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D0CECE;mso-background-themecolor:
  background2;mso-background-themeshade:230;padding:0cm 5.4pt 0cm 5.4pt;
  height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Stairs</p>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[14]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=14;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[14]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[14]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[14].'</span>/'.$count[14]."</sub></p>";?>
  </td>
  <td width=60 valign=top style='width:44.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[13]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=13;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[13]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[13]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[13].'</span>/'.$count[13]."</sub></p>";?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:25.6pt'>
  <td width=1226 colspan=18 valign=top style='width:919.65pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:white;mso-background-themecolor:background1;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:25.6pt'>
  <td width=118 colspan=2 rowspan=2 valign=top style='width:88.85pt;border:
  solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[29]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=29;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[29]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[29]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[29].'</span>/'.$count[29]."</sub></p>";?>
  </td>
  <td width=81 rowspan=5 valign=top style='width:60.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=237 colspan=4 rowspan=5 valign=top style='width:178.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#FFC000;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;background:#FFC000;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
  margin;mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;background:#FFC000;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
  margin;mso-element-top:30.6pt;mso-height-rule:exactly'>Ground 1</p>
  </td>
  <td width=75 rowspan=5 valign=top style='width:56.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[43]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:-21.75pt;margin-bottom:.0001pt;text-align:center;
  text-indent:21.75pt;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>

<?php if($floor=='G') echo"Electricity Room";else{$num=43;
echo"<sub><b><span style='color:#008440'>".$iocount[43]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[43]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
 href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[43].'</span>/'.$count[43]."</sub>"; }?></a></p>

  </td>
  <td width=301 colspan=4 rowspan=5 valign=top style='width:225.95pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#FFC000;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Ground 2</p>
  </td>
  <td width=68 rowspan=5 valign=top style='width:50.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[12]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=12;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[12]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[12]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[12].'</span>/'.$count[12]."</sub></p>";?>
  </td>
  <td width=119 colspan=2 rowspan=2 valign=top style='width:89.3pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:28.85pt'>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[30]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:28.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=30;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[30]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[30]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
  href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[30].'</span>/'.$count[30]."</sub></p>";?>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[42]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:28.85pt'>
  <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:-21.75pt;margin-bottom:.0001pt;text-align:center;
  text-indent:21.75pt;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php if($floor=='G'){
    echo"<sub><b><span style='color:#008440'>".$iocount[42]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[42]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'   
   href='room-info.php?room=".$floor."42&hostel=".$hostel."'>Warden Room</a><sub><b><span style='color:#0037ff'>".$present[42].'</span>/'.$count[42]."</sub></p>";}else {
     $num=42;
    echo"<sub><b><span style='color:#008440'>".$iocount[42]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[42]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
    href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[42].'</span>/'.$count[42]."</sub>"; }?>
 
  






</td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[11]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:28.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=11;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[11]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[11]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[11].'</span>/'.$count[11]."</sub></p>";?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:52.9pt'>
  <td width=118 colspan=2 valign=top style='width:88.85pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#00B0F0;padding:0cm 5.4pt 0cm 5.4pt;height:52.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Common Bathroom</p>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:52.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[41]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:52.9pt'>
  <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:-21.75pt;margin-bottom:.0001pt;text-align:center;
  text-indent:21.75pt;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>
  <?php if($floor=='G') echo"Health Care <br>Room";else{$num=41;
  echo"<sub><b><span style='color:#008440'>".$iocount[41]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[41]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[41].'</span>/'.$count[41]."</sub>"; }?></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:52.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=119 colspan=2 valign=top style='width:89.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#00B0F0;padding:0cm 5.4pt 0cm 5.4pt;
  height:52.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Common Bathroom</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:27.15pt'>
  <td width=118 colspan=2 rowspan=2 valign=top style='width:88.85pt;border:
  solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[31]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=31;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[31]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[31]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[31].'</span>/'.$count[31]."</sub></p>";?>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D0CECE;mso-background-themecolor:
  background2;mso-background-themeshade:230;padding:0cm 5.4pt 0cm 5.4pt;
  height:27.15pt'>
  <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:-21.75pt;margin-bottom:.0001pt;text-align:center;
  text-indent:21.75pt;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Stairs</p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[10]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=10;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[10]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[10]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[10].'</span>/'.$count[10]."</sub></p>";?>
  </td>
  <td width=119 colspan=2 rowspan=2 valign=top style='width:89.3pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:27.15pt'>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[32]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=32;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[32]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[32]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[32].'</span>/'.$count[32]."</sub></p>";?>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:-21.75pt;margin-bottom:.0001pt;text-align:center;
  text-indent:21.75pt;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[9]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=9;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[9]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[9]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[9].'</span>/'.$count[9]."</sub></p>";?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:27.15pt'>
  <td width=1226 colspan=18 valign=top style='width:919.65pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:white;mso-background-themecolor:background1;padding:0cm 5.4pt 0cm 5.4pt;
  height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:25.6pt'>
  <td width=59 valign=top style='width:44.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:<?php echo $color[33]?>;mso-background-themecolor:accent1;mso-background-themetint:
  51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=33;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[33]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[33]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[33].'</span>/'.$count[33]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[34]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=34;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[34]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[34]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[34].'</span>/'.$count[34]."</sub></p>";?>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D0CECE;mso-background-themecolor:
  background2;mso-background-themeshade:230;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Stairs</p>
  </td>
  <td width=81 rowspan=3 valign=top style='width:60.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[37]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=37;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[37]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[37]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[37].'</span>/'.$count[37]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[38]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=38;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[38]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[38]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[38].'</span>/'.$count[38]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[39]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=39;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[39]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[39]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[39].'</span>/'.$count[39]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[40]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=40;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[40]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[40]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[40].'</span>/'.$count[40]."</sub></p>";?>
  </td>
  <td width=150 colspan=2 valign=top style='width:112.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Balcony</p>
  </td>
  <td width=123 valign=top style='width:92.2pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[1]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>

<?php if($floor=='G') echo"Visitor Room";else{$num=1;
echo"<sub><b><span style='color:#008440'>".$iocount[1]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[1]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
 href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[1].'</span>/'.$count[1]."</sub>"; }?>
</p>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[2]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=2;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[2]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[2]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[2].'</span>/'.$count[2]."</sub></p>";?>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[3]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=3;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[3]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[3]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[3].'</span>/'.$count[3]."</sub></p>";?>
  </td>
  <td width=60 valign=top style='width:44.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[4]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=4;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[4]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[4]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[4].'</span>/'.$count[4]."</sub></p>";?>
  </td>
  <td width=68 rowspan=3 valign=top style='width:50.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#D0CECE;mso-background-themecolor:
  background2;mso-background-themeshade:230;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Stairs</p>
  </td>
  <td width=59 valign=top style='width:44.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[8]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=8;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[8]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[8]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[8].'</span>/'.$count[8]."</sub></p>";?>
  </td>
  <td width=60 valign=top style='width:44.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[7]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:25.6pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=7;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[7]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[7]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[7].'</span>/'.$count[7]."</sub></p>";?>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:27.15pt'>
  <td width=118 colspan=2 rowspan=2 valign=top style='width:88.85pt;border:
  solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[36]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=36;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[36]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[36]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[36].'</span>/'.$count[36]."</sub></p>";?>
  </td>
  <td width=237 colspan=4 rowspan=2 valign=top style='width:178.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=150 colspan=2 rowspan=2 valign=top style='width:112.75pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  background:#d291ea;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'>Entrance</p>
  </td>
  <td width=301 colspan=4 rowspan=2 valign=top style='width:225.95pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[6]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=6;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[6]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[6]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[6].'</span>/'.$count[6]."</sub></p>";?>
  </td>
  <td width=119 colspan=2 rowspan=2 valign=top style='width:89.3pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:white;mso-background-themecolor:
  background1;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;mso-yfti-lastrow:yes;height:27.15pt'>
  <td width=84 valign=top style='width:62.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[35]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=35;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[35]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[35]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[35].'</span>/'.$count[35]."</sub></p>";?>
  </td>
  <td width=68 valign=top style='width:50.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:<?php echo $color[5]?>;mso-background-themecolor:
  accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:27.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:margin;
  mso-element-top:30.6pt;mso-height-rule:exactly'><?php $num=5;if($floor=='G')$num-=1;
  echo"<sub><b><span style='color:#008440'>".$iocount[5]."
  </b></span></sub><sup><b><span style='color:red'>".$leavecount[5]."</b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'
   href='room-info.php?room=".$floor.$num."&hostel=".$hostel."'>".$floor.$num."</a><sub><b><span style='color:#0037ff'>".$present[5].'</span>/'.$count[5]."</sub></p>";?>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 width="30%" style='position: relative; width:30%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:17.45pt'>
  <td width=178 colspan=2 valign=top style='width:133.55pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>LEGENDS<o:p></o:p></b></p>
  </td>
  </tr>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:17.45pt'>
  
  <td width=178 colspan=2 valign=top style='width:133.55pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><?php echo"<sub><b><span style='color:#008440'>Kkl
  </b></span></sub><sup><b><span style='color:red'>Ab
  </b></span></sup><a style='color: black; text-decoration: none; background-color: transparent;'>Room</a>
  <sub><b><span style='color:#0037ff'>Prst</span>/Count</sub></p>";?>
  <o:p></o:p></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:17.45pt'>
  <td width=82 valign=top style='width:61.8pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
   style='margin-left:2.15pt;border-collapse:collapse;border:none;mso-border-alt:
   solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
    height:13.0pt'>
    <td width=62 valign=top style='width:46.15pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;background:#D9E2F3;mso-background-themecolor:
    accent1;mso-background-themetint:51;padding:0cm 5.4pt 0cm 5.4pt;height:
    13.0pt'>
    <p class=MsoNormal><o:p></o:p></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><o:p></o:p></p>
  </td>
  <td width=96 valign=top style='width:71.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <p class=MsoNormal>Empty<o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:18.25pt'>
  <td width=82 valign=top style='width:61.8pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:18.25pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
   style='margin-left:2.15pt;border-collapse:collapse;border:none;mso-border-alt:
   solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
    height:13.0pt'>
    <td width=62 valign=top style='width:46.15pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;background:yellow;padding:0cm 5.4pt 0cm 5.4pt;
    height:13.0pt'>
    <p class=MsoNormal><o:p></o:p></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><o:p></o:p></p>
  </td>
  <td width=96 valign=top style='width:71.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:18.25pt'>
  <p class=MsoNormal>1 hosteller allocated<o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:17.45pt'>
  <td width=82 valign=top style='width:61.8pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
   style='margin-left:2.15pt;border-collapse:collapse;border:none;mso-border-alt:
   solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
    height:13.0pt'>
    <td width=62 valign=top style='width:46.15pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;background:#b5ffc5;padding:0cm 5.4pt 0cm 5.4pt;
    height:13.0pt'>
    <p class=MsoNormal><o:p></o:p></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><o:p></o:p></p>
  </td>
  <td width=96 valign=top style='width:71.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <p class=MsoNormal>2 hostellers allocated<o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;mso-yfti-lastrow:yes;height:17.45pt'>
  <td width=82 valign=top style='width:61.8pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
   style='margin-left:2.15pt;border-collapse:collapse;border:none;mso-border-alt:
   solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
    height:13.0pt'>
    <td width=62 valign=top style='width:46.15pt;border:solid windowtext 1.0pt;
    mso-border-alt:solid windowtext .5pt;background:#ffcfbc;padding:0cm 5.4pt 0cm 5.4pt;
    height:13.0pt'>
    <p class=MsoNormal><o:p></o:p></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal><o:p></o:p></p>
  </td>
  <td width=96 valign=top style='width:71.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.45pt'>
  <p class=MsoNormal>&gt;2 hostellers allocated<o:p></o:p></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

<p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>

</div>
  