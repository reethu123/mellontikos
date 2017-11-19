<?php 
    include("Database.php");

    // Form values from Book Appointment page
    $Patient_id = $_POST['id'];
    $Dept_id=$_POST['dept'];
    $Doctor_id=$_POST['doctor'];
    $Time=$_POST['time'];
    $Date_=$_POST['date'];

    // Fetching Patient Name and Email id from database
    $sql_1 = "select * from patient_list where ID = '$Patient_id'";
    $sql_1_ = mysqli_query($conn, $sql_1);
    while ($email = mysqli_fetch_row($sql_1_))
    {
    	$Email_id = $email[6];
    	$Name = $email[1];
    }

    // Fetching Doctor from database
    $sql_2 = "select * from doctor_list where ID = '$Doctor_id'";
    $sql_2_ = mysqli_query($conn, $sql_2);
    while ($doctor = mysqli_fetch_row($sql_2_))
    {
    	$Doctor_name = $doctor[2];
    }

    // Insert appointment details to database and send a confirmation mail.
    $sql = "INSERT INTO appointment_list (Patient_id, Dept_id, Doctor_id, Time, Date) VALUES ('$Patient_id','$Dept_id','$Doctor_id','$Time','$Date_')";
    if (mysqli_query($conn, $sql))
    {
    	$to=$Email_id;
        $subject = "APPOINTMENT CONFIRMATION MAIL - MELLONTIKOS HOSPTIAL";
        $txt = "
        Patient Name :".$Name.",
        Appointment Date:".$Date_."	,	
        Appointment Time:".$Time.",		
        Doctor:".$Doctor_name.".";
        $headers = "From: dfsmtech@gmail.com";
        mail($to,$subject,$txt,$headers);
        
        // Redirected to View Appointment page
        header( "Location: View_Appointment.php?id=$Patient_id" );
        exit();
     
    }
?>