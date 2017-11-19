<?php
    session_start();

    if( isset($_GET['resend']) )
    {
        //Your authentication key

	$authKey = "2bZsvjCPyq";

	//Multiple mobiles numbers separated by comma

	$mobileNumber = $_SESSION["moblie"];

	//Sender ID,While using route4 sender id should be 6 characters long.

	$senderId = "mellontikoshosptial";

	//Your message to send, Add URL encoding here.

	$rndno= $_SESSION['otp'];

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

	$to=$_SESSION['email'];
    
	$subject = "OTP - MELLONTIKOS HOSPTIAL";

	$txt = "OTP: ".$rndno;

	$headers = "From: dfsmtech@gmail.com";
	mail($to,$subject,$txt,$headers);


    }
?>
<!-- OTP VERIFICATION Page -->
<!DOCTYPE html>
<html>
    <title>OTP VERIFICATION</title>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container be-detail-container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <br>
                    <img src="https://cdn2.iconfinder.com/data/icons/luchesa-part-3/128/SMS-512.png" class="img-responsive" style="width:200px; height:200px;margin:0 auto;"><br>
                    
                    <h1 class="text-center">Verify your mobile number</h1><br>
                    <p class="lead" style="align:center"></p>
                    <p>   Thanks for giving your details.  An OTP has been sent to your Mobile Number and Email Id. Please enter the 4 digit OTP below for Successful Registration.</p>  <p></p>
                    <br>
               
                    <form method="post" id="veryfyotp" action="otpprocess.php">
                        <div class="row">                    
                            <div class="form-group col-sm-8">
                        	 <span style="color:red;"></span>                    
                        	 <input type="text" class="form-control" name="otpvalue" placeholder="Enter your OTP number" required="">
                            </div>
                            <button type="submit" class="btn btn-primary  pull-right col-sm-3">Verify</button> 
                            <br><br><a href="otp.php?resend=1" id="resend_btn" style="" > Resend OTP</a>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>        
        </div>
    </body>
</html>