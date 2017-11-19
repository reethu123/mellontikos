<?php 
  include("Database.php");
?>

<!DOCTYPE html>
<html>
  <title>Mellontikos Hosptial || Doctors </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
      // Patient Id
      $id = $_GET['id'];
      // Department Id
      $dept_id = $_GET['dept_id'];
    ?>

    <?php
      // Fetching data from department table
      $dept_name = mysqli_query($conn,"select * from department_list where ID ='$dept_id' ");
      $dep_name = mysqli_fetch_row($dept_name);
      // Department Name
      $name_dept = $dep_name[1];
      $list = mysqli_query($conn,"select * from doctor_list where Dept_id ='$dept_id' "); 
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
      <div class="w3-container" style="margin-top:60px" id="showcase">
        <h1 class="w3-jumbo"><b>Department of <?php echo $name_dept; ?></b></h1>       
      </div>
      
      <br>
      <a href="Department_list.php?id=<?php echo $id; ?>" ><--Back to Departments</a>
          
      <!-- List -->
      <div class="w3-container" id="services" style="margin-top:30px">

        <table id="list">
          <tr>
            <th>Name of the Doctors</th>
            <th>Contact No.</th>
            <th>Email Id</th>
          </tr>  
              <?php
              while ($dep_list = mysqli_fetch_row($list))
              {
                echo '<tr><td>' . $dep_list[2] . '</td><td>' . $dep_list[3] . '</td><td>'.$dep_list[4].'</td></tr>';
              }

              ?>
        </table>

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
    </script>

  </body>
</html>
