<?php
	include("Database.php");

	// Checking wheather login details are valid
	extract($_POST);
	if(isset($submit))
	{
	    $user_name = strtolower($user_id);
		$rs=mysqli_query($conn,"select * from patient_list where Name='$user_name' and Password='$pass'");

		if(mysqli_num_rows($rs) < 1)
		{
			$found="N";
		}
		else
		{
			$_SESSION["login"]=$user_id;
			$row=mysqli_fetch_row($rs);
		}
	}
	if (isset($_SESSION["login"]))
	{
	  ?>
		<script>
			window.location.href = "https://mellontikoshosptial.000webhostapp.com/Login_Module/Dashboard.php?id=<?php echo $row[0]; ?>";
		</script>

	<?php
		// exit();
	}

	?>
<!DOCTYPE html>
<html>
	<head>
		<title>MELLONTIKOS HOSPITAL || LOGIN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
		    body {
				background-image: url(../images/8.jpg); 

				-moz-background-size: cover;
				-webkit-background-size: cover;
				background-size: cover;
				background-position: top center !important;
				background-repeat: no-repeat !important;
				background-attachment: fixed;
			}

		</style>
	</head>
	<body >
		<center>
			   
			<div class="floating-box" style="margin-top: 45px;">
			    <center>
			        <H1>LOG IN </H1>
			        <br><br>
					<form name="form1" method="post">
						<label for="uname">Full Name</label>
						<input type="text" id="loginid2" name="user_id" style="width: 187px;" placeholder="Enter Full Name" title="Enter Full Name"><br><br>
						<label for="pwd">Password</label>
						<input type="password" id="pass2" name="pass" style="width: 187px;" placeholder="Enter Password" title="Enter Password"><br><br>
						<input name="submit" type="submit" id="submit" value="Login" title="Log In"><br>
						<p>New User <a href="../Patient_Registry_module/Register.php" title="Register">Register Here</a></p>


						<?php if(isset($found))
						{
						    echo '<p class="w3-center w3-text-red">Invalid user id or password<br><a href="Login_page.php">Please try again.</p>';
						}
						?>

					</form>
					<a href="Forgot_pwd.php">Forgot password?</a>
				</center>
			</div>
		</center>
	</body>
</html>