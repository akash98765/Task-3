<?php
session_start();
header('Content-type: image/jpeg');

$text= $_SESSION['secure'];
$font_size=20;

$image_width=110;
$image_height=40;

$image= imagecreate($image_width,$image_height);
imagecolorallocate($image,255,255,255);
$text_color=imagecolorallocate($image,0,0,0);
$color=imagecolorallocate($image,255,0,0);
 for($x=1;$x<=30;++$x){
   $x1=rand(1,50);
   $x2=rand(1,50);
   $y1=rand(1,60);
   $y2=rand(1,60);
  imageline($image,$x1,$y1,$x2,$y2,$text_color);  
}

imagettftext($image,$font_size,0,15,30,$text_color,'Calibri.ttf',$text);
imagejpeg($image);
?>
