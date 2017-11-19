<?php 
// Update Edited Details into Database
	include("Database.php");

	$id = $_POST['id'];
	$name=strtolower($_POST['name']);
	$email=$_POST['email'];
	$moblie=$_POST['moblie'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];

	$sql = "UPDATE patient_list SET Name ='$name', Gender ='$gender', Moblie_no ='$moblie', Age ='$age', Email_id ='$email', Address ='$address' WHERE id='$id'";
	mysqli_query($conn, $sql);

	// Redirected to Dashboard
	header( "Location: Dashboard.php?id=$id" );

?>