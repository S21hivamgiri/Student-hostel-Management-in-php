<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
 //   error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password'],'role'=>"Warden"]);
    if(!$result){
        header("location:../index.php");
    }
    $host=$result['hostelno'];
    $document = $collection->academics;

 $c= $document->findOne(['role'=>'hostel' ,'hostel'=>$host]);
 $ccode=$c['hostel-for'];

    if($ccode=='male')
    $sn="BH";
    else $sn="GH"

?>  
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
   <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <div class="centerstage">
        <div class="infostage">
            <br>
            <div class="border">
                <div class="">
                   <form action="" method="POST">
                         <div class="img-ctn-h1 spread">
                                  <h1>Room Accessories</h1>
                            </div>
                            <br>

                        <div class="form-group">
                        <label for="search">Enter Room Number</label>
                        <select name="floor-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                            <option value="" hidden></option>
                            <option value="G">G</option>
                            <option value="F">F</option>
                            <option value="S">S</option>
                            <option value="T">T</option>
                            <option value="R">R</option>
                        </select>   
                        <input type="number" class="form-control spec-4" min="1" max="43" name="roomNo" placeholder="Enter Room Number" required>
                </div>
                <div class="form-group">
                        <label for="search">Enter Number of Cots</label>
                        <select name="cot-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                    </select>   
                </div>
                <div class="form-group">
                        <label for="search">Enter Number of Chair</label>
                        <select name="chair-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                    </select>   
                </div>
                <div class="form-group">
                        <label for="search">Enter Number of Tables</label>
                        <select name="tab-select" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        <option value="1">1</option>
                        <option value="2"selected>2</option>
                        <option value="3">3</option>
                    </select>   
                </div>
                <div class="form-group">
                        <label>Enter the Status of the room</label>
                        <select name="status" style=" border-radius:4px;" class="floor-select-st shift-up"required>
                        <option value="" hidden></option>
                        <option value="1">allotable</option>
                        <option value="-2">under maintainance</option>
                        <option value="-1">non-allotable(sick room/visitor room)</option>
                    </select>   
                </div>
                <div class="form-group center-align">
                    <input type="submit" name="numm" value="Submit" class="btn btn-primary img-ctn-btn">
                </div>
                </form>

                <?php
 if(isset($_POST['numm']))
 {
     $room= $_POST['floor-select'].$_POST['roomNo'];
     $document = $collection->room;
     $count = $document->count(
        ['room_no' => $room,'hostelno'=>$host]);
     if($count==0)
     {
        $InsertResult = $document->insertOne(
            ['room_no' => $room,'hostelno'=>$host, 'acc-update'=>0]);
         

     }
     
     $findResult = $document->findOne(
        ['room_no' => $room,'hostelno'=>$host]);
     
     
     
        if($findResult['acc-update']!=1)
     {
     $updateResult = $document->updateOne(
        ['room_no' => $room,'hostelno'=>$host],
        ['$set' => [
            'cot1'=> 'NITPY/'. $sn.'/COT/2018/',
            'cot2'=> 'NITPY/'. $sn.'/COT/2018/',
            'cot3'=> 'NITPY/'. $sn.'/COT/2018/',
            'chair1'=> 'NITPY/'. $sn.'/CHR/2018/',
            'chair2'=> 'NITPY/'. $sn.'/CHR/2018/',
            'chair3'=> 'NITPY/'. $sn.'/CHR/2018/',
            'tab1'=> 'NITPY/'. $sn.'/RTBL/2018/',
            'tab2'=> 'NITPY/'. $sn.'/RTBL/2018/',
            'tab3'=> 'NITPY/'. $sn.'/RTBL/2018/',
            ]]
    );
}
     $tab=$_POST['tab-select'];
     $chair=$_POST['chair-select'];
     $cot= $_POST['cot-select'];

     $_SESSION['tab']=$tab;
      $_SESSION['cot']=$cot;
      $_SESSION['chair']=$chair;
       $_SESSION['room']=$room;
       $_SESSION['status']=$_POST['status'];
     
       $find = $document->findOne(
        ['room_no' => $_SESSION['room'],'hostelno'=>$host]);
     
     
       echo'<form method="post"><div class="section_sub_title">
         <h1>Cots</h1>
     </div>
     <div class="questionBank">
     <table class="cotTable">
         <thead>
             <tr class="firstRow">
                 <td>SNo.</td>
                 <td>Cot</td>
                 <td>Cot_id</td>
             </tr>
         </thead>
         <tbody>
         ';
         for($i=1;$i<=$_SESSION['cot'];$i++)

     {  echo '<tr> <td>'.$i.'.</td>
             <td>Cot '.$i.'</td>
             <td><input type="text" class="field-value" name="cot'.$i.'" value="'.$find['cot'.$i].'" required></td>
             </tr>';
         }
            
             echo'
     </tbody>
     </table>
     <div class="section_sub_title">
         <h1>Chairs</h1>
     </div>
     <table class="chairTable">
         <thead>
             <tr class="firstRow">
                 <td>SNo.</td>
                 <td>Chair</td>
                 <td>Chair_id</td>
             </tr>
         </thead>
         <tbody>
         ';
         for($i=1;$i<=$_SESSION['chair'];$i++)

     {  echo '<tr> <td>'.$i.'.</td>
             <td>Chair '.$i.'</td>
             <td><input type="text" class="field-value" name="chair'.$i.'" value="'.$find['chair'.$i].'" required></td>
             </tr>';
         }
            
             echo'
          </tbody>
     </table> 
     <div class="section_sub_title">
         <h1>Tables</h1>
     </div>
     <table class="tableTable">
         <thead>
             <tr class="firstRow">
                 <td>SNo.</td>
                 <td>Table</td>
                 <td>Table_id</td>
             </tr>
         </thead>
         <tbody>
         ';
         for($i=1;$i<=$_SESSION['tab'];$i++)

     {  echo '<tr>
             <td>'.$i.'.</td>
             <td>Table '.$i.'</td>
             <td><input type="text" class="field-value" name="tab'.$i.'" value="'.$find['tab'.$i].'" required></td>
             </tr>';
         }
            
             echo'
         
         
          </tbody>
     </table> 
 <br>
 <input type="submit" name="subb" value="Submit Details" class="btn btn-primary img-ctn-btn">

 </form>
 <br><br><br><br>
</div>
</div>';
 }

                    
if(isset($_POST['subb']))
{

$document = $collection->room;
$date=date("Y-m-d h:i:sa");
          
$updateResult = $document->updateOne(
    ['room_no' => $_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'update-date'=> $date,
       'acc-update'=> 1,
       'status'=>$_SESSION['status']
    ]]
);
for($i=1;$i<=$_SESSION['cot'];$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' => $_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'cot'.$i =>$_POST['cot'.$i]
    ]]
);
}
for($i=1;$i<=$_SESSION['chair'];$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' =>$_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'chair'.$i =>$_POST['chair'.$i]
    ]]
);
}
for($i=$_SESSION['chair']+1;$i<=3;$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' =>$_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'chair'.$i =>""
    ]]
);
}
for($i=1;$i<=$_SESSION['tab'];$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' => $_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'tab'.$i =>$_POST['tab'.$i]
    ]]
);
}
for($i=$_SESSION['cot']+1;$i<=3;$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' =>$_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'cot'.$i =>""
    ]]
);
}
for($i=$_SESSION['chair']+1;$i<=3;$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' =>$_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'chair'.$i =>""
    ]]
);
}
for($i=1;$i<=$_SESSION['chair'];$i++)
{ 
$updateResult = $document->updateOne(
    ['room_no' =>$_SESSION['room'],'hostelno'=>$host],
    ['$set' => [
       'chair'.$i =>$_POST['chair'.$i]
    ]]
);
}


echo "  <div class='alert alert-success index-alert-upd' role='alert'>
The room accerrories has been successfully updated to ".$_SESSION['room'] . " of ". $host."
</div>";
}

                       
                        
                    

?>
            </div>
        </div>
    </div>
<script src="../assets/js/scripts.js"></script>