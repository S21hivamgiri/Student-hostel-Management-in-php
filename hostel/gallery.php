<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gallery</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <link rel="icon" href="images/welcomeImg2.gif">  
    <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="./assets/css/camera.css">
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/jquery-migrate-1.2.1.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/superfish.js"></script>
    <script src="./assets/js/jquery.ui.totop.js"></script>
    <script src="./assets/js/jquery.equalheights.js"></script>
    <script src="./assets/js/jquery.mobilemenu.js"></script>
    <script src="./assets/js/jquery.easing.1.3.js"></script>
    <script src="./assets/js/owl.carousel.js"></script>
    <script src="./assets/js/camera.js"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="./assets/js/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    <script>
        $(document).ready(function() {
            jQuery('#camera_wrap').camera({
                loader: false,
                pagination: false,

                thumbnails: false,
                height: '46%',
                width: '100%',
                caption: true,
                navigation: true,
                fx: 'mosaic'
            });
            /*carousel*/
            var owl = $("#owl");
            owl.owlCarousel({
                items: 2, //10 items above 1000px browser width
                itemsDesktop: [995, 2], //5 items between 1000px and 901px
                itemsDesktopSmall: [767, 2], // betweem 900px and 601px
                itemsTablet: [700, 2], //2 items between 600 and 0
                itemsMobile: [479, 1], // itemsMobile disabled - inherit from itemsTablet option
                navigation: true,
                pagination: false
            });
            $().UItoTop({
                easingType: 'easeOutQuart'
            });
        });
    </script>
</head>

<body class="" id="top">
    <!--==============================header=================================-->
    <div class="slider_wrapper">
        <div id="camera_wrap" class="">
  
            <div data-src="./assets/images/slide.jpg">
                <div class="caption fadeIn">
                     <a class="link"> Entrance,NIT Puducherry</a>
                <a href="index.php"> <button type="button" class="btn btn-danger pos">X</button></a>  

                   
                  

                </div>
            </div>
            <div data-src="./assets/images/slide1.jpg">
                <div class="caption fadeIn">
                    <a class="link"> Girl's Hostel,NIT Puducherry</a>
                <a href="index.php"> <button type="button" class="btn btn-danger pos">X</button></a>  

                </div>
            </div>
            <div data-src="./assets/images/slide2.jpg">
                <div class="caption fadeIn">
                  <a class="link"> Boy's Hostel,NIT Puducherry</a>  
                    <a href="index.php"> <button type="button" class="btn btn-danger pos">X</button></a>  
                     
                </div>
            </div>
        </div>
    </div>
    <!--==============================footer=================================-->

</body>

</html>