$dh = $(document).height();
$nh = $('nav').height();
$fh = $dh - $nh;
$ph = (($fh * 100) / $dh) - 2.5;
$('.centerstage').css('height', $ph + "vh");