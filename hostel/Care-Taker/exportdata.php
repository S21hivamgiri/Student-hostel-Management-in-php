<?php
session_start();
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
//error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$result = $document->find(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
if(!$result){
    header("location:../index.php");
}


$document = $collection->feedback;

$query = $document->find(['year'=>$_SESSION['year'],'month'=>$_SESSION['month'],'hostel'=> $_SESSION['hostel'],]);
 

if($query){
    $delimiter = ",";
    $filename = "feedback-" .$_SESSION['month'].'-'.$_SESSION['year'].'-'.$_SESSION['hostel'] . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array( 'Name', 'Year','Roll No.', 'Dept', 'Course', 'Specialization','Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10', 'Q11', 'Q12', 'remark', 'remark2','poll','Total Point');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
   foreach($query as $row ){
        $total=$row['q1']+$row['q2']+ $row['q3']+ $row['q4']+ $row['q5']+$row['q6']+ $row['q7']+ $row['q8']+ $row['q9']+ $row['q10']+ $row['q11']+ $row['q12'];
        $lineData = array($row['name'], $row['stuyear'], $row['roll_no'], $row['dept'], $row['course'], $row['veg'],$row['q1'], $row['q2'], $row['q3'], $row['q4'], $row['q5'], $row['q6'], $row['q7'], $row['q8'], $row['q9'], $row['q10'], $row['q11'], $row['q12'], $row['r1'], $row['r2'], $row['poll'],$total);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>