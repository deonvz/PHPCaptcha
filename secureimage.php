<?php
// Simple Captcha by Deon van Zyl
// 2009
// Requires PHP & GD libraries
// ---------
// This allows a Image with wording to display (Captcha)
// The user submits what is displayed to show that he isn`t a bot
// -----------

// Error debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check for GD Lib
if (extension_loaded('gd') && function_exists('gd_info')) {
   echo "PHP GD library is installed on your web server";
}
else {
   echo "PHP GD library is NOT installed on your web server";
}

//set up image
header ('Content-Type: image/png');
$height = 80;
$width = 120;
$im = ImageCreate($width,$height)  or die('Cannot Initialize new GD image stream');// Setup blank img
$white = ImageColorAllocate($im,255,255,255); //RGB Val
$black = ImageColorAllocate($im,0,0,0);
$blue =  ImageColorAllocate($im,1,130,230);
$yellow = ImageColorAllocate($im,157,254,2);
$grey = imagecolorallocate($im, 128, 128, 128);

$centerx=100;
$centery=100;


//draw on Image
ImageFill($im,0,0,$white);
ImageLine($im,0,0,$width,$height,$grey);
ImageLine($im,40,0,$width,$height,$blue);
ImageLine($im,80,0,$width,$height,$grey);
ImageLine($im,100,0,$width,$height,$blue);
ImageLine($im,100,0,$width,$height,$blue);

ImageFill($im,0,0,$white);

$moveit_x=mt_rand(-50, -1);
$moveit_x2=mt_rand($moveit_x+1, 50);
$moveit_sub=mt_rand(1, 500);
$moveit_sub2=mt_rand($moveit_sub+2, 10000);

  for ($x=-100;$x<=100;$x++)
   {
    for ($sub=500;$sub<=10000;$sub+=500)
       {
       $new=($x*$x*$x)/$sub;
       imagesetpixel ($im, ($centerx+$x), ($centery-$new), $blue);
       imagesetpixel ($im, ($centery-$new),($centerx+$x) , $yellow);
       imagesetpixel ($im, ($centerx-$x), ($centery-$new), $yellow);
       imagesetpixel ($im, ($centery+$new),($centerx+$x) , $blue);
       }
   }

imagesetpixel ($im, 40, 50, $yellow);

 // Replace path by your own font path
$font = 'C:\WINDOWS\Fonts\arial.ttf';
 // Add some shadow to the text if needed and not passed in URL
// $encryptedpassword='test';
 imagettftext($im, 20, 0, 6, 52, $grey, $font, $encryptedpassword);
 // Add the text
 imagettftext($im, 20, 0, 5, 50, $black, $font, $encryptedpassword);

 //output image
 ImagePng($im)  or die('Cannot Initialize new GD image stream');

// //Clean up
 ImageDestroy($im);

?>


