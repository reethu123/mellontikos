<?php 
  include("Database.php");

  $id = $_GET['id']; 
  $rs=mysqli_query($conn,"select * from patient_list where ID='$id'");
  $row=mysqli_fetch_row($rs);

  // User Password
  $password = $row[7];

?>

<!DOCTYPE html>
<html>
  <title>Mellontikos Hosptial || Change Password </title>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    <style>
      body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
      body {font-size:16px;}
      .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
      .w3-half img:hover{opacity:1}
    </style>

    <script>

      // To Check Old Password is correct
      function validateForm()
      {
          var old_pwd = document.getElementById('old_password').value;
          var new_pwd = document.getElementById('new_password').value;
          var old_pwd_db = '<?php echo $password; ?>';
          if (old_pwd_db != old_pwd)
          {
            alert("Old password is incorrect.Please enter correct password");
      		  return false;
          }
          return true;
      }
    </script>
  </head>
  <body>

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
      <div class="w3-container"  id="showcase">
        <h1 class="w3-jumbo"><b>Change Password</b></h1> 
      </div>
      
      
      <!-- Change pwd -->
      <div class="w3-container" id="services" style="margin-top:25px">
        <form name="change_pwd" method="post" action="change.php"  onsubmit="return validateForm()">
          <input type="text" name="id" value="<?php echo $id; ?>" hidden>
          <p><h3>OLD PASSWORD :</h3>  <input type="password" name="old_password" id="old_password" size="20" value="" placeholder="ENTER OLD PASSWORD" required></p>
          <p><h3>NEW PASSWORD :</h3>  <input type="password" name="new_password" id="new_password" size="20" value="" placeholder="ENTER NEW PASSWORD" required></p>
          <p><input type="submit" name="btn-save" title="Change Password" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" value="CONFIRM"></p>
        </form>

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
