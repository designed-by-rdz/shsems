<?php
session_start();
$captcha = rand(10000, 99999);
$_SESSION["captcha"] = $captcha;  
$im = imagecreatetruecolor(100, 20);  
$bg = imagecolorallocate($im, 23, 36, 37);
$fg = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $bg); 
imagestring($im, rand(2, 5), rand(5, 55), rand(-1, 8),  $captcha, $fg);
header("Cache-Control: no-store,no-cache, must-revalidate"); 
header('Content-type: image/png');
imagepng($im); 
imagedestroy($im);
?>