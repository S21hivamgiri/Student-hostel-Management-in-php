 <?php 
  session_start();
 
require_once "../vendor/autoload.php";
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);

$client = (new MongoDB\Client);
$collection = $client->hostel;
$document = $collection->users;

$af = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
if(!$af){
    header("location:../index.php");
}
              $document = $collection->emergency;
             
                if(isset($_POST['updatemer'])){
                    $upload_date = date("l d-m-Y");
                     $insertStmt = $document->updateOne([
                       
                        'id'=>htmlspecialchars($_GET['id'])],
                        ['$set'=>[
                        'name'=>$_POST['emergency-name'],
                        'desg'=>$_POST['emergency-des'],
                        'email'=>$_POST['emergency-email'],
                        'contact'=>$_POST['emergency-num'],
                        'remark'=>$_POST['emergency-remark'],
                        'upload_date' => $upload_date
                        
                        
                        
                    ]]);
                    header("location:update-emergency.php");
                        
                }
?>