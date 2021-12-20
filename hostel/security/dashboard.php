<?php include('../dashboardheader.php'); 

require_once "../vendor/autoload.php";
    date_default_timezone_set("Asia/Kolkata");
    error_reporting(0);

    $client = (new MongoDB\Client);
    $collection = $client->hostel;
    $document = $collection->users;

    $result = $document->findOne(['username' => $_SESSION['username'], 'password' => ($_SESSION['password']),'role'=>'Security']);
    if(!$result){
        header("location:../index.php");
    }


    ?>

    <div class="centerstage row">
        <div class="menu_bar col-lg-2 col-md-2">
            <ul class="left_section">
                <li class="main_header list-item-1" id="1"><i class="fas fa-users"></i>  Allocate Room</li>
                    <div class="dropdown allocate_room_dropdown">
                        <ul class="dropdown_list">
                            <li class="list_item sick-room" id="13">Gym In/Out</li>
                            <div class="dropdown allocate_sick_room_dropdown">
                                <ul class="dropdown_list">
                                    <li class="list_item_new room-sick-entry" id="13">In Entry</li>
                                    <li class="list_item_new outstanding-sick-entry" id="17">Out Entry</li>
                                    <li class="list_item_new general-sick-register" id="18">General Register</li>        
                                </ul>
                            </div>
                            <li class="list_item medicine-room" id="12">Health-Care Room</li>
                            <div class="dropdown allocate_medicine_room_dropdown">
                                <ul class="dropdown_list">
                                    <li class="list_item_new room-medicine-entry" id="13">In Entry</li>
                                    <li class="list_item_new outstanding-medicine-entry" id="17">Out Entry</li>
                                    <li class="list_item_new general-medicine-register" id="18">General Register</li>        
                                </ul>
                            </div>
                            <li class="list_item common-room" id="14">Common Room</li>
                            <div class="dropdown allocate_common_room_dropdown">
                                <ul class="dropdown_list">
                                    <li class="list_item_new room-common-entry" id="13">In Entry</li>
                                    <li class="list_item_new outstanding-common-entry" id="17">Out Entry</li>
                                    <li class="list_item_new general-common-register" id="18">General Register</li>        
                                </ul>
                            </div>
                            <li class="list_item guest-room" id="15">Guest Room</li>
                            <div class="dropdown allocate_guest_room_dropdown">
                                <ul class="dropdown_list">
                                <li class="list_item_new vis-entry" id="17">In Entry</li>
                                    <li class="list_item_new outstanding-guest-entry" id="17">Outstanding Entry</li>
                                    <li class="list_item_new general-guest-register" id="18">General Register</li>        
                                </ul>
                            </div>
                        </ul>
                    </div>
                    
                <li class="main_header list-item-3" id="3"><i class="fas fa-users"></i> Leave Register</li>
                    <div class="dropdown leave_dropdown">
                        <ul class="dropdown_list">
                            <li class="list_item departure" id="16">Departure of Hosteller</li>
                            <li class="list_item arrival" id="17">Arrival of Hosteller</li>
                            <li class="list_item journey-register" id="18">Journey Register</li>
                            <li class="list_item on-journey" id="19">Students on Journeys</li>
                        </ul>
                    </div>
                    <li class="main_header list-item-2" id="2"><i class="fas fa-users"></i>  In/Out Register</li>
                    <div class="dropdown inout_dropdown">
                        <ul class="dropdown_list">
                            <li class="list_item out-entry" id="17">Out Entry</li> 
                            <li class="list_item outstanding-entry" id="17">Outstanding Entry</li>
                            <li class="list_item general-register" id="18">General Register</li>
                        </ul>
                    </div>
                <li class='list-item full-width logy' id='4' >
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
            <iframe src="../welcome.php" frameborder="0" class="ifrm">
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
    $('.allocate_room_dropdown').hide();
    $('.allocate_guest_room_dropdown').hide();
    $('.allocate_sick_room_dropdown').hide();
    $('.allocate_common_room_dropdown').hide();
    $('.allocate_medicine_room_dropdown').hide();
    $('.inout_dropdown').hide();
    $('.leave_dropdown').hide();
    $('.list-item-1').click(function(){
        $('.allocate_room_dropdown').show();
        $('.allocate_guest_room_dropdown').hide();
        $('.allocate_sick_room_dropdown').hide();
        $('.allocate_common_room_dropdown').hide();
        $('.allocate_medicine_room_dropdown').hide();
        $('.inout_dropdown').hide();
        $('.leave_dropdown').hide();
    });
    $('.list-item-2').click(function(){
        $('.allocate_room_dropdown').hide();
        $('.inout_dropdown').show();   
        $('.leave_dropdown').hide();
    
    });
    $('.list-item-3').click(function(){
        $('.allocate_room_dropdown').hide();
        $('.inout_dropdown').hide();   
        $('.leave_dropdown').show();
    
    });
    $('.sick-room').click(function(){
        $('.allocate_guest_room_dropdown').hide();
        $('.allocate_sick_room_dropdown').show();
        $('.allocate_common_room_dropdown').hide();
        $('.allocate_medicine_room_dropdown').hide();      
    });
    $('.common-room').click(function(){
        $('.allocate_guest_room_dropdown').hide();
        $('.allocate_sick_room_dropdown').hide();
        $('.allocate_common_room_dropdown').show();
        $('.allocate_medicine_room_dropdown').hide();      
    });
    $('.medicine-room').click(function(){
        $('.allocate_guest_room_dropdown').hide();
        $('.allocate_sick_room_dropdown').hide();
        $('.allocate_common_room_dropdown').hide();
        $('.allocate_medicine_room_dropdown').show();      
    });
    $('.guest-room').click(function(){
        $('.allocate_guest_room_dropdown').show();
        $('.allocate_sick_room_dropdown').hide();
        $('.allocate_common_room_dropdown').hide();
        $('.allocate_medicine_room_dropdown').hide();      
    });
    // $('.sick-room').click(function(){
    //     $('.ifrm').attr("src", "sick-room.php");
    // });
    // $('.medicine-room').click(function(){
    //     $('.ifrm').attr("src", "medicine-room.php");
    // });
    // $('.common-room').click(function(){
    //     $('.ifrm').attr("src", "common-room.php");
    // });
    $('.vis-entry').click(function(){
        $('.ifrm').attr("src", "vis-entry.php");
    });
   
     $('.out-entry').click(function(){
        $('.ifrm').attr("src", "out-entry.php");
    });    

    $('.general-sick-register').click(function(){
        $('.ifrm').attr("src", "general-register.php?room_select=Gym Room");
    });
    $('.outstanding-sick-entry').click(function(){
        $('.ifrm').attr("src", "in-entry.php?room_select=Gym Room");
    });
    $('.departure').click(function(){
        $('.ifrm').attr("src", "departure.php");
    });
    $('.arrival').click(function(){
        $('.ifrm').attr("src", "arrival.php");
    });


    
    $('.outstanding-common-entry').click(function(){
        $('.ifrm').attr("src", "in-entry.php?room_select=Common Room");
    });
    $('.general-common-register').click(function(){
        $('.ifrm').attr("src", "general-register.php?room_select=Common Room");
    }); 


    $('.outstanding-entry').click(function(){
        $('.ifrm').attr("src", "outstanding-entry.php?room_select=In/Out");
    });
    $('.general-register').click(function(){
        $('.ifrm').attr("src", "general-register.php?room_select=In/Out");
    });

   
    $('.outstanding-guest-entry').click(function(){
        $('.ifrm').attr("src", "inside-entry.php?room_select=Visitor Room");
    });
    $('.general-guest-register').click(function(){
        $('.ifrm').attr("src", "visitor-register.php?room_select=Visitor Room");
    }); 

   
    $('.outstanding-medicine-entry').click(function(){
        $('.ifrm').attr("src", "in-entry.php?room_select=HealthCare Room");
    });
    $('.general-medicine-register').click(function(){
        $('.ifrm').attr("src", "general-register.php?room_select=HealthCare Room");
    }); 
    $('.journey-register').click(function(){
        $('.ifrm').attr("src", "travelhistory.php");
    });   
    $('.on-journey').click(function(){
        $('.ifrm').attr("src", "on-journey.php");
    });

     $('.room-sick-entry').click(function(){
        $('.ifrm').attr("src", "just-history.php?room_select=Gym Room");
    });    
     $('.room-common-entry').click(function(){
        $('.ifrm').attr("src", "just-history.php?room_select=Common Room");
    });
      $('.room-medicine-entry').click(function(){
        $('.ifrm').attr("src", "just-history.php?room_select=HealthCare Room");
    });
</script>
<?php include('../dashboardfooter.php'); ?>