<?php 

include("Database.php");

?>



<?php

    

    // Handle AJAX request (start)

    if( isset($_POST['ajax']) && isset($_POST['name']) && isset($_POST['email']) )
    {

    	$user_name = strtolower($_POST['name']);

    	$user_email = $_POST['email'];

        $patient = mysqli_query($conn,"select * from patient_list where Name = '$user_name' and Email_id = '$user_email'");

        $vaild = mysqli_num_rows($patient);

    

        if ($vaild > 0) 
        {

        	echo "true";

        	exit();

        }
        else
        {

        	echo "false";

        	exit();

        }

    }

?>

<!DOCTYPE html>

<html>

	<head>

	    <link rel="stylesheet" href="style.css">

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	    <meta name="viewport" content="width=device-width, initial-scale=2">

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<script>



			// Function to check whether user already exist or not

			function user_chker(name, email)
			{

				$.ajax({

    			    type: 'post',

    			    data: {ajax: 1,name: name,email: email},

    			    success: function(response){

    	                    var status = response;

    	                   // alert(response);
    	                    var n = status.search("true");

    	                    if (n > 0) 
    	                    {

    	                        alert("Already exist an account. Please Log In");

    	                        window.location.href = "../Login_Module/Login_page.php";

    	                    }

    	              }

    			});

				return;

			}



			// Function to Validate values

			function validateForm() {

			    var name = document.getElementById('name');

			    var age = document.getElementById('age');

			    var moblie = document.getElementById('moblie');

			    var email = document.getElementById('email');

			    var address = document.getElementById('address');



                user_chker(name.value , email.value );

    

			    // Validate Name

			    var alphaExp = /^[a-zA-Z ]*$/;

				if(!name.value.match(alphaExp))
				{

					alert("NAME SHOULD BE ALPHABETS ONLY");

					name.focus();

					return false;

				}



				// validate moblie

				var numericExpression = /^\d{10}$/;

				if(!moblie.value.match(numericExpression))
				{

					alert("Please enter a valid moblie number");

					moblie.focus();

					return false;

				}



				// validate email

				var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

				if(!email.value.match(emailExp))
				{

					alert("Please enter a valid email address");

					email.focus();

					return false;

				}



				//validate Address

				

				if( (address.value.length < 10) || (address.value.length > 100) )
				{

					alert("Address must be between 10 to 100 characters.");

					address.focus();

					return false;

				}



				// validate age

				age = parseInt(age, 10);

			 

				

				if (!(isNaN(age) || age > 150))
				{ 

			  		alert("Enter a valid age");

			  		return false;

				}



				return true;

			}

		</script>

		<style>

		    body {

				background-image: url(../images/12.jpg); 



				-moz-background-size: cover;

				-webkit-background-size: cover;

				background-size: cover;

				background-position: top center !important;

				background-repeat: no-repeat !important;

				background-attachment: fixed;

			}

		</style>

	</head>

	<title>PATIENT REGISTRATION FORM</title>

	<body>

		<center>



			<div class="floating-box" style="padding-left: 45px;">

				<center>



					<center><h1>PATIENT REGISTRATION FORM</h1></center>



					<form name="registration_form" method="post" action="registration_form.php"  onsubmit="return validateForm()">

						<table>

							

							<tr><td>

								NAME: <input type="text" name="name" id="name" size="60" value="" placeholder="ENTER PATIENT NAME" required>

								<br><br>

							</td></tr>  

							<tr><td>

								GENDER:

								<input type="radio" name="gender" value="f" required>Female

								<input type="radio" name="gender" value="m">Male

								<br><br>

							</td></tr>  

							<tr><td>

								AGE: <input type="number" name="age" id="age" size="7" value="" placeholder="ENTER AGE" required>

								<br><br>

							</td></tr>    

							<tr><td>

								MOBLIE NUMBER: <input type="number" name="moblie" id="moblie" size="12" value="" placeholder="ENTER MOBLIE NO" required>

								<br><br>

							</td></tr>  

								<tr><td>

								EMAIL ID: <input type="text" name="email" id="email" size="20" value="" placeholder="ENTER EMAIL ID" required>

								<br><br>

							</td></tr> 

							<tr><td>

								ADDRESS: <textarea name="address" id="address" rows="4" cols="40" placeholder="ENTER ADDRESS"></textarea>

								<br><br>



								PASSWORD: <input type="password" name="password" id="password" size="20" value="" placeholder="ENTER PASSWORD" required>

								<br><br>

								<center>

									<input type="submit" name="btn-save" value="REGISTER" title="REGISTER">

								</center>

								<center>

									<p>Already have an account? <a href="../Login_Module/Login_page.php" title="LOG IN">Login Here</a></p>

								</center>

							</td></tr> 

						</table>

					</form>

				</center>

			</div>

		</center>

	</body>

</html>