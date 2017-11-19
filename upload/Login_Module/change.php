<?php 
	// To Change Password
	include("Database.php");

	$id = $_POST['id'];
	$pwd=$_POST['new_password'];

	$sql = "UPDATE patient_list SET Password = '$pwd' WHERE id='$id'";
	mysqli_query($conn, $sql);
	// Redirecting to dashboard
	header( "Location: Dashboard.php?id=$id" );

?>