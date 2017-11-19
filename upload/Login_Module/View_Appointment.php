<?php 
  include("Database.php");
?>

<?php $id = $_GET['id']; ?>

<?php
  // Ajax to Delete Appointment
  if( isset($_POST['ajax']) && isset($_POST['value']) )
  {
    // Delete Appointment
    $app_id = $_POST['value'];
    $date_sql = mysqli_query($conn,"select Date from appointment_list where ID ='$app_id'");
    $Date_ = mysqli_fetch_row($date_sql);
    mysqli_query($conn,"Delete from appointment_list where ID ='$app_id'"); 
      
    // Patient Email id
    $sql = "Select * from patient_list where ID='$id'";
    $email = mysqli_query($conn, $sql);
    $email_id = mysqli_fetch_row($email);

    // Sending  cancellation mail
    $to=$email_id[6];
    $subject = "APPOINTMENT CANCELLATION MAIL - MELLONTIKOS HOSPTIAL";
    $txt = ' '.$email_id[1].', your appointment on '.$Date_[0].' at Mellontikos Hosptial was cancelled.';
    $headers = "From: dfsmtech@gmail.com";
    mail($to,$subject,$txt,$headers);

    exit;
  }
?>

<!DOCTYPE html>
<html>
  <title>Mellontikos Hosptial || Appointments </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

  </style>
  <body>
        
    <?php

      // Listing All Appointments
      $app = mysqli_query($conn,"select * from appointment_list where Patient_id=$id");
      $i = 0;
      while ($app_list = mysqli_fetch_row($app))
      {
        $app_id[$i] = $app_list[0];
        $dept[$i] = $app_list[2];
        $doct[$i] = $app_list[3];
        $time[$i] = $app_list[4];
        $date[$i] = $app_list[5];
        $i++;
      }

      // Total no of Appointments
      $no_of_app = $i;

      // Department Name
      for ($i=0; $i < $no_of_app; $i++) 
      { 
        $dept_name_id = $dept[$i];
        $dept_sql = mysqli_query($conn,"select Name from department_list where ID = '$dept_name_id'");    
        while ($dept_sql_ = mysqli_fetch_row($dept_sql))
        {
          $dept_name[$i] = $dept_sql_[0];
        } 
      }

      // Doctor's Name
      for ($i=0; $i < $no_of_app; $i++) 
      { 
        $doc_name_id = $doct[$i];
        $doc_sql = mysqli_query($conn,"select Name from doctor_list where ID = '$doc_name_id'");    
        while ($doc_sql_ = mysqli_fetch_row($doc_sql))
        {
          $doc_name[$i] = $doc_sql_[0];
        } 
      }

    ?>
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
      <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
      <div class="w3-container">
        <h3 class="w3-padding-64"><b>Mellontikos<br>Hosptial</b></h3>
      </div>
      <div class="w3-bar-block">
        <a href="Dashboard.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Dashboard</a>
        <a href="Edit_details.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Edit Personal Details</a> 
        <a href="Change_pwd.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Change Password</a> 
        <a href="Book_Appointment.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Book Appointment</a> 
        <a href="View_Appointment.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Veiw Appointments</a> 
        <a href="Department_list.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Departments</a> 
        <a href="Contact.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact Us</a>
        <a href="Login_page.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Log Out</a>
      </div>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
      <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
      <span>Mellontikos Hosptial</span>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:340px;margin-right:40px">

      <!-- Header -->
      <div class="w3-container" style="margin-top:70px" id="showcase">
        <h1 class="w3-jumbo"><b>Appointments</b></h1>       
      </div>
      
      
      <!-- Appointments -->
      <div class="w3-container" id="services" style="margin-top:35px">
        <span id="upcoming"></span>
        <div id="appointments">
          <table id="list">
            <tr>
              <th>Department</th>
              <th>Doctor</th>
              <th>Date</th>
              <th>Time</th>
              <th></th>
            </tr>  
              <?php
              for ($i=0; $i < $no_of_app; $i++) 
              { 
                echo '<tr id="app_'.$app_id[$i].'"><td>' . $dept_name[$i] . '</td><td>' . $doc_name[$i] . '</td><td>'. $date[$i] . '</td><td>'. $time[$i] . '</td><td><button type="button" title="Delete Appointment" onclick="Delete_appt('.$app_id[$i].');"><center>X</center></button></td></tr>';
              }

              ?>
          </table>
        </div>

      </div>
      


     
    <!-- End page content -->
    </div>

    <!-- Container -->
    <div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Powered by Mellontikos Hosptial</p></div>

    <script>
      // Script to open and close sidebar
      function w3_open() {
          document.getElementById("mySidebar").style.display = "block";
          document.getElementById("myOverlay").style.display = "block";
      }
       
      function w3_close() {
          document.getElementById("mySidebar").style.display = "none";
          document.getElementById("myOverlay").style.display = "none";
      }
      
      var number = '<?php echo $no_of_app; ?>';
      if (number <= 0) 
      {
        document.getElementById("appointments").remove();
        document.getElementById('upcoming').innerHTML = "No Appointments.<p id='btn_app'></p>";
        var element = document.createElement("input");
        element.type = 'submit';
        element.value = 'Book Appointment';
        element.title = 'Book Appointment';
        element.name = 'book_app_btn';
        element.className ='w3-button w3-block w3-padding-large w3-red w3-margin-bottom';
        element.onclick = function () {
         window.location = 'Book_Appointment.php?id=<?php echo $id; ?>';
        }
        
        document.getElementById("btn_app").appendChild(element);
      }

      // Function to Delete Appointment
      function Delete_appt(app_id)
      {
          var r = confirm("Do You Want To Delete Your Appointment?");
          if (r = true) 
          {
             $.ajax({
                  type: 'post',
                  data: {ajax: 1,value: app_id},
                  success: function(response){
                      $('#app_'+app_id).empty();

                      var rows = document.getElementById("list").getElementsByTagName("tr").length;
                      
                      if(rows <= 2 )
                      {
                          document.getElementById("list").remove();
                          document.getElementById("appointments").remove();
                          document.getElementById('upcoming').innerHTML = "No Appointments.<p id='btn_app'></p>";
                          var element = document.createElement("input");
                          element.type = 'submit';
                          element.value = 'Book Appointment';
                          element.title = 'Book Appointment';
                          element.name = 'book_app_btn';
                          element.className ='w3-button w3-block w3-padding-large w3-red w3-margin-bottom';
                          element.onclick = function () {
                            window.location = 'Book_Appointment.php?id=<?php echo $id; ?>'; 
                          }
                          document.getElementById("btn_app").appendChild(element);
                      }
                  }
              });
          };
      }
    </script>

  </body>
</html>
