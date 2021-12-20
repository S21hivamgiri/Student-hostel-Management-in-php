<?php 
    session_start();
    require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => $_SESSION['password']]);
    if(!$result){
        header("location:../index.php");
    }
    $rid = $result['wdn_id'];
  

?>
<!doctype html>
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
    <div class="cp-div pwd-wide">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="img-ctn-h1">
                <h1>Update Profile Image</h1>
            </div>
            <br>
            <div class="form-group">
                <?php
                if(isset($_POST['submit']))
                {
                    $target_dir = "../assets/img/Warden/";
                    $file_name=$_FILES["fileToUpload"]["name"];
					$tmp = explode('.', $_FILES["fileToUpload"]["name"]);
					$file_extension = end($tmp);
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            // echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            File is not an image.
                            </div>";
                            $uploadOk = 0;
                        }
                    }
                    
                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 1000000) {
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Sorry, your file is too large.
                            </div>";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "<div class='alert alert-danger index-alert-upd' role='alert'>
                            Sorry, only JPG, JPEG, PNG & GIF files are allowed.
                            </div>";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                                    Sorry, your file was not uploaded.
                                </div>";
                    // if everything is ok, try to upload file
                    } else {
                        $_FILES["fileToUpload"]["name"]=$rid.'.'.$file_extension;
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "  <div class='alert alert-success index-alert-upd' role='alert'>
                                The file ". $file_name. " has been uploaded.
                            </div>";
                        } else {
                            echo "  <div class='alert alert-danger index-alert-upd' role='alert'>
                                Sorry, there was an error uploading your file.
                            </div>";
                        }
                    }
                    $_SESSION['filename'] = basename( $_FILES["fileToUpload"]["name"]);
                    $updateQuery = $document->updateOne(['wdn_id' => $rid], 
                    ['$set' => ['filename' => $_SESSION['filename']]]);
                }
                ?>
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br><br>
                <div class="full-screen">
                    <input type="submit" class="btn btn-primary img-ctn-btn" value="Upload Image" name="submit">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</html>