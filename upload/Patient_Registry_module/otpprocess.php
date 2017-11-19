<?php
    session_start();
    // Create connection
    $url='localhost';
    $username = "id3589213_reethudas";
    $password = "reethudas";
    $dbname = "id3589213_patient_portal";

    $conn = mysqli_connect($url, $username, $password, $dbname);
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    $rno=$_SESSION['otp'];
    $urno=$_POST['otpvalue'];
    if(!strcmp($rno,$urno))
    {
        // Form Values stored in session
        $name=strtolower($_SESSION['name']);
        $email=$_SESSION['email'];
        $phone=$_SESSION['moblie'];
        $gender = $_SESSION['gender'];
        $age= $_SESSION['age'];
        $address = $_SESSION['address'];
        $password = $_SESSION['password'];

        // Add Patient details into database
        $sql = "INSERT INTO patient_list (Name, Gender, Moblie_no, Age, Email_id, Address, Password)
        VALUES ('$name','$gender','$phone','$age','$email','$address','$password')";
        if (mysqli_query($conn, $sql))
        {
            // Sending CONFIRMATION MAIL
            $to=$email;
            $subject = "CONFIRMATION MAIL - MELLONTIKOS HOSPTIAL";
            
            $txt = "Thank u for register with us. 
            Click here to Log in : https://mellontikoshosptial.000webhostapp.com/Login_Module/Login_page.php";
            $headers = "From: dfsmtech@gmail.com";
            mail($to,$subject,$txt,$headers);
            $authKey = "abcdefghijkakkkanhas";
            $mobileNumber = $phone;
            //Sender ID,While using route4 sender id should be 6 characters long.
            $senderId = "MELLON";
            //Your message to send, Add URL encoding here.
            $message = urlencode("Thank u for register with us. we will get back to u shortly.");
            //Define route 
            $route = "route=4";
            //Prepare you post parameters
            $postData = array(
                'authkey' => $authKey,
                'mobiles' => $mobileNumber,
                'message' => $message,
                'sender' => $senderId,
                'route' => $route
            );
            
            header( "Location: sucess.php" );
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        return true;
    }
    else
    {
        header('Location: failure.php');
        exit();
    }
?>