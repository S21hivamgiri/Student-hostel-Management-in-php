<?php include('../dashboardheader.php'); 
$date=date('d-m');
$datey=date('Y');

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

$bmonth=strtotime($result['b_date']);
$b_day=date('d-m',$bmonth);
$dateb=date('Y',$bmonth);
// echo "<div id ='mydiv'>Your last login performed at ". $_SESSION['time']."</div>";

?>
    <div class="centerstage row">
        <div class="menu_bar col-lg-2 col-md-2">
            <ul class="left_section">
                
                
                <li class="main_header" id="1"><i class="fas fa-users"></i>  Personal Information</li>
                <div class="dropdown personal_information_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item view-profile" id="25">View Profile</li>
                        <li class="list_item update-username" id="17">Update Username</li>
                        <li class="list_item update-password" id="34">Update Password</li>
                        <li class="list_item update-image" id="54">Update Profile Image</li>
                    </ul>
                </div>
              
         
              

                <li class="main_header" id="11"><i class="fas fa-school"></i>  Academics</li>
                <div class="dropdown academics_feedback_dropdown">
                    <ul class="dropdown_list">
                        <li class="list_item hostel-insert" id="21">Insert Hostel</li>
                        <li class="list_item courses-insert" id="24"> Insert Courses</li>
                        <li class="list_item dept-insert" id="22">Insert Department</li>
                        <li class="list_item mapping" id="26">Roll No. Mapping</li>
                        <li class="list_item verify-pass" id="28">Verify Passout(+4 years Students)</li>
                        <li class="list_item update-masterpassword" id="28">Update Master Password</li>
                        <li class="list_item update-sem" id="28">Update Student's Year Explicitly</li>
                   
                    </ul>
                </div>
               
                <li class='list-item full-width logy' id='7' >
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
            <ul class='time-cont b3'>
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
       echo' <iframe src="../welcome.php" frameborder="0" class="ifrm">';
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
         $('.notice_section_dropdown').hide();
         $('.personal_information_dropdown').hide();
         $('.student_section_dropdown').hide();        
         $('.hostel_feedback_dropdown').hide();
         $('.grievance_section_dropdown').hide();
         $('.room_complaints_dropdown').hide();
         $('.emergency_contact_dropdown').hide();
         $('.academics_feedback_dropdown').hide();
        $('.leave_feedback_dropdown').hide();
        $('.fees_feedback_dropdown').hide();
        $('.general_contact_dropdown').hide();
        $('.rep_contact_dropdown').hide();
       $('.feedback_section_dropdown').hide();
       $('.spo_med_contact_dropdown').hide();
         $('#1').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').fadeToggle();
             $('.student_section_dropdown').hide();        
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide(); 
             $('.emergency_contact_dropdown').hide();     
               $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide();
             $('.general_contact_dropdown').hide(); 
               $('.rep_contact_dropdown').hide();
                  $('.feedback_section_dropdown').hide();
                   $('.spo_med_contact_dropdown').hide();
         });
        $('#12').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
              $('.spo_med_contact_dropdown').hide();
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();      
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
               $('.rep_contact_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.general_contact_dropdown').fadeToggle();      
         });
         $('#2').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').fadeToggle();        
             $('.hostel_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
             $('.grievance_section_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();
               $('.rep_contact_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();    
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();      
         });
         $('#3').click(function(){
             $('.notice_section_dropdown').fadeToggle();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();    
                $('.feedback_section_dropdown').hide();    
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
               $('.rep_contact_dropdown').hide();
             $('.emergency_contact_dropdown').hide();
             $('.room_complaints_dropdown').hide();    
             $('.leave_feedback_dropdown').hide();
             $('.academics_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide();     
             $('.general_contact_dropdown').hide();    
         });
         $('#4').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();        
             $('.hostel_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
               $('.rep_contact_dropdown').hide();
             $('.grievance_section_dropdown').fadeToggle();
             $('.room_complaints_dropdown').hide();  
                $('.feedback_section_dropdown').hide();
             $('.emergency_contact_dropdown').hide();    
              $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide();
             $('.general_contact_dropdown').hide();      
         });
         $('#5').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();        
             $('.hostel_feedback_dropdown').hide();
               $('.rep_contact_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.emergency_contact_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
             $('.room_complaints_dropdown').fadeToggle();    
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.fees_feedback_dropdown').hide();
             $('.general_contact_dropdown').hide();         
         });
         $('#6').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();
               $('.rep_contact_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').fadeToggle();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();    
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();        
                $('.feedback_section_dropdown').hide();
         });
         $('#8').click(function(){
             $('.notice_section_dropdown').hide();
               $('.rep_contact_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').fadeToggle();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();      
             $('.academics_feedback_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
             $('.general_contact_dropdown').hide();       
         });
          $('#9').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
               $('.rep_contact_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();      
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
             $('.fees_feedback_dropdown').fadeToggle(); 
             $('.general_contact_dropdown').hide();    
                $('.feedback_section_dropdown').hide();  
         });
          $('#10').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();      
             $('.leave_feedback_dropdown').fadeToggle();
             $('.academics_feedback_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.fees_feedback_dropdown').hide();
             $('.general_contact_dropdown').hide();
               $('.rep_contact_dropdown').hide();       
         });
          $('#11').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide(); 
              $('.spo_med_contact_dropdown').hide(); 
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();      
             $('.academics_feedback_dropdown').fadeToggle();
             $('.leave_feedback_dropdown').hide();
                $('.feedback_section_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();
               $('.rep_contact_dropdown').hide();      
      
         });
  $('#13').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide(); 
              $('.spo_med_contact_dropdown').hide();   
             $('.academics_feedback_dropdown').hide();
             
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();
               $('.rep_contact_dropdown').fadeToggle();
                  $('.feedback_section_dropdown').hide();      
      
         });
           $('#14').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();    
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();
              $('.spo_med_contact_dropdown').hide();
               $('.rep_contact_dropdown').hide();
                  $('.feedback_section_dropdown').fadeToggle();      
      
         });
           $('#15').click(function(){
             $('.notice_section_dropdown').hide();
             $('.personal_information_dropdown').hide();
             $('.student_section_dropdown').hide();  
             $('.emergency_contact_dropdown').hide();      
             $('.hostel_feedback_dropdown').hide();
             $('.grievance_section_dropdown').hide();
             $('.room_complaints_dropdown').hide();    
             $('.academics_feedback_dropdown').hide();
             $('.leave_feedback_dropdown').hide();
             $('.fees_feedback_dropdown').hide(); 
             $('.general_contact_dropdown').hide();
              $('.spo_med_contact_dropdown').fadeToggle();
               $('.rep_contact_dropdown').hide();
                  $('.feedback_section_dropdown').hide();      
      
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
        $('.fee-details').click(function () {
            $('#15').addClass('changeBG');
            $('#12').removeClass('changeBG');
            $('#13').removeClass('changeBG');
            $('#14').removeClass('changeBG');
            $('.ifrm').attr("src", "fees.php");
        });

        $('.allocate-room').click(function () {
            $('#16').addClass('changeBG');
            $('#17').removeClass('changeBG');
            $('#18').removeClass('changeBG');
            $('.ifrm').attr("src", "alloc.php");
        });

        $('.de-allocate-room').click(function () {
            $('#16').removeClass('changeBG');
            $('#17').addClass('changeBG');
            $('#18').removeClass('changeBG');
            $('.ifrm').attr("src", "deactive.php");
        });
        
        $('.search-student').click(function () {
            $('#16').removeClass('changeBG');
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('.ifrm').attr("src", "search-student.php");
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

        $('.update-notice').click(function () {
            $('#19').toggleClass('changeBG');
            $('.ifrm').attr("src", "update-notice.php");
            $('.notice_section_dropdown').show();
        });
		 
        $('.view-feedback').click(function () {
            $('#17').addClass('changeBG');
            $('#18').removeClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-feedback.php");
        });


        $('.view-menu').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "menu.php");
        });
		 $('.update-menu').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-menu.php");
        });
        $('.view-grievance').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-grievance.php");
        });
		$('.view-notice').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-notice.php");
        });
        $('.act-feedback').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "act-feedback.php");
        });
        $('.view-complaint').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-complaint.php");
        });
        
        $('.reallocate-rooms').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "re-alloc.php");
        });

        $('.acc-details').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "roomacc.php");
        });
        $('.all-graph').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "allocation-graph.php");
        });
        $('.room-details').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "room-det.php");
        });
        $('.verify-pass').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "pass.php");
        });
        $('.leave-grant').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "leave-grant.php");
        });
        
        $('.mapping').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "mapping.php");
        });
            
        $('.view-emer').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-emergency.php");
        });
            
        $('.update-emer').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-emergency.php");
        });
        $('.insert-emer').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "insert-emergency.php");
        });
        $('.view-out').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "on-journey.php");
        });
        $('.view-attendance').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-attendance.php");
        });
        
        $('.att-graph').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "attendance-graph.php");
        });
        $('.fee-unpaid').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "fees-unpaid.php");
        });
        $('.view-fee').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "fee-view.php");
        });
         $('.hostel-insert').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-hostel.php");
        });
         $('.dept-insert').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-department.php");
        });

         $('.courses-insert').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-courses.php");
        });
           $('.reset-fees').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "reset-fees.php");
        });
          $('.view-contact').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-contact.php");
        });
            
        $('.update-contact').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-contact.php");
        });
        $('.insert-contact').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "insert-contact.php");
        });
        
          $('.update-masterpassword').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "update-masterpassword.php");
        });
         $('.update-sem').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "change-sem.php");
        });
         $('.allot-rep').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "allocate-hr-mr-pres-vice.php");
        });
         $('.deallot-rep').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "remove-creds.php");
        });
         $('.view-rep').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "view-creds.php");
        });
        $('.view-inout').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "in-town.php");
        });
         $('.out-verify').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
            $('.ifrm').attr("src", "out-verify.php");
        });
         $('.allocate-visitor').click(function () {
            $('#17').removeClass('changeBG');
            $('#18').addClass('changeBG');
            $('#16').removeClass('changeBG');
          $('.ifrm').attr("src", "room-entry.php?room_select=Visitor Room");
        });
    $('.view-sports').click(function(){
        $('.ifrm').attr("src", "view-sport.php");
    });
    $('.view-med').click(function(){
        $('.ifrm').attr("src", "view-medicine.php");
    });
     $('.update-sports').click(function(){
        $('.ifrm').attr("src", "update-sports.php");
    });
    $('.update-med').click(function(){
        $('.ifrm').attr("src", "update-medicine.php");
    });
     $('.insert-sports').click(function(){
        $('.ifrm').attr("src", "insert-sport.php");
    });
    $('.insert-med').click(function(){
        $('.ifrm').attr("src", "insert-medicine.php");
    });
    </script>