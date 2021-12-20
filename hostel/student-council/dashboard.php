<?php include('../dashboardheader.php'); 

require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);
    $date=date('d-m');
    $datey=date('Y');
    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password']),'role'=>'student-council']);
    if(!$result){
        header("location:../index.php");
    }

    $bmonth=strtotime($result['b_date']);
    $b_day=date('d-m',$bmonth);
    $dateb=date('Y',$bmonth);
    
    ?>
    <div class="centerstage row">
        <div class="menu_bar col-lg-2 col-md-2">
            <ul class="left_section">
                <li class="main_header" id="1"><i class="fas fa-users"></i> Personal Details</li>
                <div class="dropdown student_profile_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item view-profile" id="13">View Profile</li>
                        <li class="list_item update-username" id="12">Update Username</li>
                        <li class="list_item update-password" id="14">Update Password</li>
                        <li class="list_item update-image" id="15">Update Profile Image</li>
                    </ul>
                </div>
                <li class="main_header" id="7"><i class="fas fa-home"></i>  Going for Holiday</li>
                <div class="dropdown enter-holiday_dropdown">
                    <ul class="dropdown_list">
                    <li class="list_item enter-holiday" id="17">New Leave Form</li>
                     <li class="list_item make-entry" id="16">Travel Within Karaikal</li>
                        <li class="list_item status-holiday" id="17">View Leave status</li>
                        <li class="list_item history-holiday" id="17">Leave register</li>
                  
                    </ul>
                </div>
                <li class="main_header" id="2"><i class="fas fa-comment-dots"></i>  Mess Feedback</li>
                <div class="dropdown hostel_feedback_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item give-feedback" id="16">Give Feedback</li>
                      <li class="list_item view-menu" id="18">View Menu</li>
                    </ul>
                </div>
                
                <li class="main_header" id="5"> <i class="fas fa-sign"></i>  Notice Section</li>
                <div class="dropdown view-notice_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item view-notice" id="17">View Notice</li>
                  
                    </ul>
                </div>
                <li class="main_header" id="4"><i class="fas fa-comment-alt"></i>  Hostel Complaints</li>
                <div class="dropdown room_complaint_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item enter-complaints" id="17">Enter Complaints/See status</li>
                  
                    </ul>
                </div>
                <li class="main_header" id="3"><i class="fas fa-exclamation-triangle"></i> Grievance Cell</li>
                <div class="dropdown update-grievance_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item update-grievance" id="17">Enter Grievance/ See status</li>
                  
                    </ul>
                </div>
                
                 <li class="main_header" id="9"><i class="fas fa-h-square"></i> Acquire Facilities</li>
                <div class="dropdown acquire_section_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item view-sports" id="19">View Sports Equipments</li>
                        <li class="list_item view-med" id="19">View Medicines</li>
                        <li class="list_item acq-common" id="19">Acquire Common Room</li>
                        <li class="list_item acq-gym" id="19">Acquire Gym</li>
                        <li class="list_item acq-health" id="19">Acquire Health Care Room</li>
                    </ul>
                </div>
                 <li class="main_header" id="8"><i class="fas fa-comments"></i>  Application Feed-Back</li>
                <div class="dropdown feedback_section_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item give-app-feedback" id="19">Give FeedBack</li>
                    </ul>
                </div>
    

                <li class='list-item full-width logy' id='6' >
                    <form action="" method="POST">
                        <?php 
                            if(isset($_POST['log-out-btn'])){
                                echo "<script>window.top.location.href = '../index.php';</script>";
                                session_destroy();
                            }
                        ?>
                        <input type="submit" value="Log Out" name="log-out-btn" class="log-out-button">
                    </form>    
                </li>
            </ul>
            <ul class='time-cont'>
                <li>
                    <?php 
                        echo "<div id ='mydiv'>Last Login: <br> ". $_SESSION['time']."</div>";
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 infostage">
        <?php
         $a= strtotime($b_day.'-'.$datey);
         $b= strtotime($date.'-'.$datey);
         $i=strtotime("15-08-".$datey);
         $g=strtotime("02-10-".$datey);
         $r=strtotime("26-01-".$datey);
         $_SESSION['p_year'] =$datey-$dateb;
         $_SESSION['i_year'] =$datey-1947;
         $_SESSION['r_year'] =$datey-1950;
         if($a==$b)

         echo' <iframe src="./birthday.php" frameborder="0" class="ifrm">';
       else 
       if($i==$b)
 
         echo' <iframe src="../independence-day.php" frameborder="0" class="ifrm">';
       else 
       if($r==$b)
 
         echo' <iframe src="../republic-day.php" frameborder="0" class="ifrm">';
       else 
       
       if($g==$b)
 
       echo' <iframe src="../gandhi-jayanti.php" frameborder="0" class="ifrm">';
     else 
      
      echo' <iframe src="./welcome.php" frameborder="0" class="ifrm">';
        ?>
            </iframe>
        </div>
    </div>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script>
        setTimeout(function() {
            $('#mydiv').fadeOut('fast');
            $('.time-cont').fadeOut('fast');
        }, 4000); 

        $('.student_profile_dropdown').hide();
        $('.hostel_feedback_dropdown').hide();
        $('.room_complaint_dropdown').hide();
        $('.view-notice_dropdown').hide();
        $('.update-grievance_dropdown').hide();
        $('.enter-holiday_dropdown').hide();
           $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide();  



        $('#1').click(function(){
            $('.student_profile_dropdown').fadeToggle();
            $('.hostel_feedback_dropdown').hide();    
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.update-grievance_dropdown').hide(); 
               $('.enter-holiday_dropdown').hide();
               $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide();         
        });


        $('#2').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').fadeToggle();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.update-grievance_dropdown').hide();    
            $('.enter-holiday_dropdown').hide();      
            $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide(); 
        });

        $('#3').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.enter-holiday_dropdown').hide();
            $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide(); 
            $('.update-grievance_dropdown').fadeToggle();          
        });
        $('#4').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').fadeToggle();
            $('.view-notice_dropdown').hide();
            $('.enter-holiday_dropdown').hide();
            $('.update-grievance_dropdown').hide();   
            $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide();        
        });
        $('#5').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').fadeToggle();
            $('.update-grievance_dropdown').hide();
            $('.enter-holiday_dropdown').hide();      
            $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide();     
        });
        $('#7').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.update-grievance_dropdown').hide();
            $('.acquire_section_dropdown').hide();  
              $('.feedback_section_dropdown').hide(); 
            $('.enter-holiday_dropdown').fadeToggle();          
        });
         $('#8').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.update-grievance_dropdown').hide();
            $('.acquire_section_dropdown').hide();  
            $('.feedback_section_dropdown').fadeToggle(); 
            $('.enter-holiday_dropdown').hide();          
        });
          $('#9').click(function(){
            $('.student_profile_dropdown').hide();
            $('.hostel_feedback_dropdown').hide();
            $('.room_complaint_dropdown').hide();
            $('.view-notice_dropdown').hide();
            $('.update-grievance_dropdown').hide();
            $('.acquire_section_dropdown').fadeToggle();  
              $('.feedback_section_dropdown').hide(); 
            $('.enter-holiday_dropdown').hide();          
        });
        $('.enter-holiday').click(function () {
            $('#15').addClass('changeBG');
            $('#12').removeClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            
            
            $('.ifrm').attr("src", "leave-form.php");
        });


        
         $('.give-app-feedback').click(function () {
            $('#15').addClass('changeBG');
            $('#12').removeClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            $('.ifrm').attr("src", "app_feedback.php");
        });



        
        $('.update-image').click(function () {
            $('#15').addClass('changeBG');
            $('#12').removeClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            
            $('.ifrm').attr("src", "update-image.php");
        });

        $('.update-username').click(function () {
            $('#15').removeClass('changeBG');
            $('#12').addClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            $('.ifrm').attr("src", "update-username.php");
        });

        $('.view-profile').click(function () {
            $('#12').removeClass('changeBG');
            $('#13').addClass('changeBG');
            $('#15').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            $('.ifrm').attr("src", "view-profile.php");
        });

        $('.update-password').click(function () {
            $('#12').removeClass('changeBG');
            $('#15').removeClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').addClass('changeBG');
            $('.ifrm').attr("src", "update-password.php");
        });

        $('.give-feedback').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').removeClass('changeBG');
            $('#16').addClass('changeBG');
            $('.ifrm').attr("src", "give-feedback.php");
        });


        $('.view-menu').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "menu.php");
        });
        $('.update-grievance').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-grievance.php");
        });
        $('.view-notice').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "welcome.php");
        });
            $('.make-entry').click(function(){
        $('.ifrm').attr("src", "make-entry.php");
    }); 
        $('.enter-complaints').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-complaint.php");
        });
        $('.status-holiday').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "leave-status.php");
        });
        $('.history-holiday').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "leave-history.php");
        });
    
         $('.acq-health').click(function(){
        $('.ifrm').attr("src", "room-entry.php?room_select=HealthCare Room");
    });

        $('.acq-gym').click(function(){
        $('.ifrm').attr("src", "room-entry.php?room_select=Gym Room");
    }); 
    
    $('.acq-common').click(function(){
        $('.ifrm').attr("src", "room-entry.php?room_select=Common Room");
    });
    $('.view-sports').click(function(){
        $('.ifrm').attr("src", "view-sport.php");
    });
    $('.view-med').click(function(){
        $('.ifrm').attr("src", "view-medicine.php");
    });
    
    </script>
<?php include('../dashboardfooter.php'); ?>