<?php

	session_start();

	//Your authentication key

	$authKey = "2bZsvjCPyq";

	//Multiple mobiles numbers separated by comma

	$mobileNumber = $_POST["moblie"];

	//Sender ID,While using route4 sender id should be 6 characters long.

	$senderId = "mellontikoshosptial";

	//Your message to send, Add URL encoding here.

	$rndno=rand(1000, 9999);

	$message = urlencode("OTP :".$rndno." From : Mellontikos Hosptial");



	//SMS API URL

	$url="http://api.fast2sms.com/sms.php?token=".$authKey."&mob=".$mobileNumber."&mess=".$message."&sender=".$senderId."&route=0";





	$ch = curl_init();



	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_URL, $url);



	$data = curl_exec($ch);

	curl_close($ch);



	//otp email

	$to=$_POST['email'];
    
	$subject = "OTP - MELLONTIKOS HOSPTIAL";

	$txt = "OTP: ".$rndno;

	$headers = "From: dfsmtech@gmail.com";

	mail($to,$subject,$txt,$headers);

	if(isset($_POST['btn-save']))
	{

		$_SESSION['name']=$_POST['name'];

		$_SESSION['email']=$_POST['email'];

		$_SESSION['moblie']=$_POST['moblie'];

		$_SESSION['age']=$_POST['age'];

		$_SESSION['gender']=$_POST['gender'];

		$_SESSION['address']=$_POST['address'];

		$_SESSION['password']=$_POST['password'];

		$_SESSION['otp']=$rndno;


		header( "Location: otp.php" ); 

	} 

?>