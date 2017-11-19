<?php 
    include("Database.php");
?>

<?php
    $flag = 'false';
    if( isset($_POST['ajax']) && isset($_POST['value']) && isset($_POST['name']))
    {
        $email_id = $_POST['value'];
        $name = strtolower($_POST['name']);
        $email_sql = mysqli_query($conn,"select * from patient_list where Email_id ='$email_id' AND Name = '$name'");
        $email_ = mysqli_fetch_row($email_sql);
        $vaild = mysqli_num_rows($email_sql);
        
        if ($vaild > 0) 
        {
        	$flag = 'true';
        	$to=$email_[6];
            $subject = "FORGOT PASSWORD - MELLONTIKOS HOSPTIAL";
            $txt = 'User Name : '.$email_[1].'
            Password : '.$email_[7].'
            Click here to Login: https://mellontikoshosptial.000webhostapp.com/Login_Module/Login_page.php ';
            $headers = "From: dfsmtech@gmail.com";
            mail($to,$subject,$txt,$headers);
        }
        else
        {
        	$flag = 'false';
        }
        echo $flag;
        exit();
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
    <title>Mellotikos Hospital || Forgot Password</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="keywords" content="Reset Password Form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!--google fonts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <!--element start here-->
        <div class="elelment">
        	<div class="element-main">
        		<h1>Forgot Password</h1>
        		<p> If you have forgotten your password, enter your Full Name and Email Id.</p>
        		<form method="post" action="./Login_page.php" onsubmit="return validateForm()">
        			<input type="text" value="" placeholder="Your Full Name" id="name" required>
        			<input type="text" value="" placeholder="Your e-mail address" id="email_id" required>
        			<input type="submit" value="Submit">
        		</form>
        	</div>
        </div>
        <div class="copy-right">
        			<p>© 2016 Reset Password Form. All rights reserved | Template by  <a href="http://w3layouts.com/" target="_blank">  W3layouts </a></p>
        </div>

        <!--element end here-->
        <script>
        	function validateForm()
        	{
        		var email = document.getElementById('email_id').value;
        		var name = document.getElementById('name').value;
        		
                $.ajax({
                    type: 'post',
                    data: {ajax: 1,value: email,name: name},
                    success: function(response){
                            var status = response;
                            var n = status.search("true");
                            if (n > 0) 
                            {
                                alert("Your Password is sent to your Email Id.");
                                window.location.href = "https://mellontikoshosptial.000webhostapp.com/Login_Module/Login_page.php";
                            	return true;
                            }
                            else 
                            {
                            	alert("Your Name and Email Id are not matching.Try again");
                            	return false;
                            }
                    	}
                });
                return false;
        	}
        </script>
    </body>
</html>