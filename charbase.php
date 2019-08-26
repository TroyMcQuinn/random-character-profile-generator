<?php

// error_reporting(E_ALL);

header('Content-Type: image/jpeg');

srand((double) microtime() * 1000003);

function nitro_rand($x,$y){
	$k = mt_rand(0,1);
	if($k == 0){
		$out = rand($x,$y);
	}else{
		$out = mt_rand($x,$y);
	}
	return $out;
}

//Set path for source images
$w = 600; //width
$h = 600; //height

/*
$finalw = 120;  //Destination width
$finalh = 120; //Destination height
*/

$finalw = 600;  //Destination width
$finalh = 600; //Destination height

$path = getcwd(); //No trailing slashes

$genders = Array('male','female');

//Get gender
$gender = isset($_GET["gender"]) ? $gender = $_GET['gender'] : $gender = $genders[mt_rand(0,1)];

//Set number of images available for each layer
if($gender == "male"){
	$path .= "/male";
	$acc_limit = 5;
	$beard_limit = 6;
	$body_limit = 10;
	$brows_limit = 9;
	$clothes_limit = 9;
	$eyes_limit = 10;
	$hairfront_limit = 20;
	$mouth_limit = 9;
	$nose_limit = 9;
}else{
	$path .= "/female";
	$acc_limit = 10;
	$body_limit = 7;
	$brows_limit = 9;
	$clothes_limit = 16;
	$eyes_limit = 13;
	$hairfront_limit = 24;
	$mouth_limit = 14;
	$nose_limit = 9;
}

//First, create image.  Working image is 600x600 pixels.
$img = imagecreatetruecolor($w,$h);

//Set alpha blending
imagealphablending($img,true);

//Make background white
$white = imagecolorallocate($img,255,255,255);
$black = imagecolorallocate($img,0,0,0);
imagerectangle($img,0,0,$w,$h,$white);

//Randomly choose body / face
$temp = imagecreatefrompng($path."/"."body".nitro_rand(1,$body_limit).".png");
imagecopymerge($img,$temp,0,0,0,0,$w,$h,100);

//Add eyes
$temp = imagecreatefrompng($path."/"."eyes".nitro_rand(1,$eyes_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
//Add nose
$temp = imagecreatefrompng($path."/"."nose".nitro_rand(1,$nose_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
//Add eyebrows
$temp = imagecreatefrompng($path."/"."brows".nitro_rand(1,$brows_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
//Add mouth
$temp = imagecreatefrompng($path."/"."mouth".nitro_rand(1,$mouth_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
//Add Accessories
$ifacc = rand(0,2);
if($ifacc == 1){
	$temp = imagecreatefrompng($path."/"."acc".nitro_rand(1,$acc_limit).".png");
	imagecopy($img,$temp,0,0,0,0,$w,$h);
}
//Add clothing
$ifclothing = rand(0,20);
if($ifclothing != 1){
	$temp = imagecreatefrompng($path."/"."clothes".nitro_rand(1,$clothes_limit).".png");
	imagecopy($img,$temp,0,0,0,0,$w,$h);
}
//Add Hair Front / Top
$temp = imagecreatefrompng($path."/"."hairfront".nitro_rand(1,$hairfront_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
//Add beard if male
$ifbeard = rand(0,6);
if(($ifbeard == 1) && ($gender == "male")){
$temp = imagecreatefrompng($path."/"."beard".nitro_rand(1,$beard_limit).".png");
imagecopy($img,$temp,0,0,0,0,$w,$h);
}

/*Disabled because this operation isn't really needed and it kills the CPU
//Random slight rotate and crop
$degrees = rand(-4,4);
$zf = abs($degrees * 6); //Zoom Factor
$temp = $img;
$temp = imagerotate($temp,$degrees, 0);
//Zoom in based on how much the image was rotated.
imagecopyresampled($img,$temp,(0-$zf),(0-$zf),$zf,$zf,$w,$h,($w-$zf),($h-$zf));
imagedestroy($temp);
*/

//Add border
imagerectangle($img,0,0,$w,1,$white);
imagerectangle($img,$w-1,0,$w-1,$h,$white);
imagerectangle($img,0,$h-1,$w,$h,$white);
imagerectangle($img,0,0,1,$h,$white);



//Resample
$final = imagecreatetruecolor($finalw,$finalh);
imagecopyresampled($final,$img,0,0,0,0,$finalw,$finalh,$w,$h);
imagedestroy($img);

imageinterlace($final,1);
print imagejpeg($final,"",100);
imagedestroy($final);



?>