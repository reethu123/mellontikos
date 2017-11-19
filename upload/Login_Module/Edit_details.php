<!DOCTYPE html>
<html>
  <title>Mellontikos Hosptial || Edit </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

  <script>

    function validateForm() 
    {
      var name = document.getElementById('name');
      var age = document.getElementById('age');
      var moblie = document.getElementById('moblie');
      var email = document.getElementById('email');
      var address = document.getElementById('address');

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
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}
  </style>
  <body>
    <?php 

    include("Database.php");

    // Patient Id
    $id = $_GET['id']; 
    $rs=mysqli_query($conn,"select * from patient_list where ID='$id'");
    $row=mysqli_fetch_row($rs);

    $name = ucwords($row[1]); 
    if($row[2] == 'f')
    {
        $gender = 'Female';
    }
    else
    {
        $gender = 'Male';
    }

    $moblie = $row[3];
    $age = $row[4];
    $address = $row[5];
    $email = $row[6];


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
      <div class="w3-container"  id="showcase">
        <h1 class="w3-jumbo"><b>Edit Personal Details</b></h1>

       
      </div>
      
      
      <!-- Edit -->
      <div class="w3-container" id="services" style="margin-top:25px">
        <form name="edit_form" method="post" action="Edit.php"  onsubmit="return validateForm()">
          <input type="text" name="id" value="<?php echo $id; ?>" hidden>
          <p><h3>Name :</h3> <input type="text" name="name" id="name" size="40" value="<?php echo $name; ?>" placeholder="ENTER PATIENT NAME" required></p>
          <p><h3>Gender :</h3><input type="radio" name="gender" id="f" value="f" <?php echo ($gender== 'Female') ?  "checked" : "" ;  ?> />Female
          <input type="radio" name="gender" id="m" value="m" <?php echo ($gender== 'Male') ?  "checked" : "" ;  ?> />Male</p>
          <p><h3>Age :</h3><input type="number" name="age" id="age" size="7" value="<?php echo $age; ?>" placeholder="ENTER AGE" required></p>
          <p><h3>Moblie no :</h3><input type="number" name="moblie" id="moblie" size="12" value="<?php echo $moblie; ?>" placeholder="ENTER MOBLIE NO" required></p>
          <p><h3>Email Id :</h3><input type="text" name="email" id="email" size="30" value="<?php echo $email; ?>" placeholder="ENTER EMAIL ID" required></p>
          <p><h3>Address :</h3><textarea name="address" id="address" rows="4" cols="40" placeholder="ENTER ADDRESS"><?php echo $address; ?></textarea></p>
          <p><input type="submit" name="btn-save" title="Update" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" value="UPDATE"></p>
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
