<?php 
  include("Database.php");
?>

<?php
  // Handle AJAX request (start)

  //Ajax call on selection of department and displays doctors on that department
  if( isset($_POST['ajax_1']) && isset($_POST['value']) )
  {
      $dept_id = $_POST['value'];
      if ($dept_id == 0) 
      {
        exit;
      }

      $doctor = mysqli_query($conn,"select * from doctor_list where Dept_id = '$dept_id'");

      echo '<option value="0">---SELECT---</option>';
      while ($doctor_list = mysqli_fetch_row($doctor))
      {
        echo '<option value=' . $doctor_list[0] . '>' . $doctor_list[2] . '</option>';
      }
      
      exit;
  }

  //Ajax call on selection of doctor and displays doctor's date avaliable
  if( isset($_POST['ajax_2']) && isset($_POST['date']) )
  {
      $doc_id = $_POST['date'];
      if ($doc_id == 0) 
      {
        exit;
      }

      $date = mysqli_query($conn,"select * from doctor_list where ID = '$doc_id'");
      echo '<option value="0">---SELECT---</option>';
      while ($date_list = mysqli_fetch_row($date))
      {
        $date_str = $date_list[5];
      }
      $arr = explode(";",$date_str);
      $i = 0;
      while ($arr[$i] != NULL) 
      {
        echo '<option value=' . $arr[$i] . '>' . $arr[$i] . '</option>';
        $i++;
      }
      
      exit;
  }

  //Ajax call on selection of doctor and displays doctor's time avaliable
  if( isset($_POST['ajax_3']) && isset($_POST['time']) )
  {
      $doc_id = $_POST['time'];
      if ($doc_id == 0) 
      {
        exit;
      }

      $time = mysqli_query($conn,"select * from doctor_list where ID = '$doc_id'");

      echo '<option value="0">---SELECT---</option>';
      while ($time_list = mysqli_fetch_row($time))
      {
        $time_str = $time_list[6];
      }

      $arr_time = explode(";",$time_str);
      $i = 0;
      while ($arr_time[$i] != NULL) 
      {
        echo '<option value=' . $arr_time[$i] . '>' . $arr_time[$i] . '</option>';
        $i++;
      }
      
      exit;
  }
  // Handle AJAX request (end)

?>

<!DOCTYPE html>
<html>
  <title>Mellontikos Hosptial || Book Appointment </title>
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
    </style>
  <body>

    <?php 

    // Patient's id
    $id = $_GET['id']; 

    // All Departments 
    $dept = mysqli_query($conn,"select * from department_list");

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
        <a href="Departments_list.php?id=<?php echo $id; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Departments</a> 
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
      <div class="w3-container" style="margin-top:80px" id="showcase">
        <h1 class="w3-jumbo"><b>Book Appointment</b></h1>      
      </div>
      
      
      <!-- Book appointment -->
      <div class="w3-container" id="book_appointment" style="margin-top:33px">
        <p>
          <form name="book_appointment_form" method="post" action="Book.php">
            <input type="text" name="id" value="<?php echo $id; ?>" hidden>
            DEPARTMENT : 
            <select name="dept" id="dept" onChange="doctor_list(this.value);">
              <option value="0">---SELECT DEPARTMENT---</option>
              <?php
                while ($dept_list = mysqli_fetch_row($dept))
                {
                  echo '<option value=' . $dept_list[0] . '>' . $dept_list[1] . '</option>';
                }
              ?>
            </select><br><br>
            DOCTOR : 
            <select name="doctor" id="doctor" onChange="date_list(this.value);"></select><br><br>
            DATE : 
            <select name="date" id="date" onChange="activate_btn();" ></select><br><br>
            TIME : 
            <select name="time" id="time" onChange="activate_btn();"></select><br><br>
            <input type="submit" title="Book Appointment" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" value="BOOK APPOINTMENT" disabled>
          </form>
        </p>
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
    <script type="text/javascript">

      // Functions calling Ajax 

      // Function on the onChange of department
      function doctor_list(str)
      {
        var e = document.getElementById("dept");
        var value = e.options[e.selectedIndex].value;
        
          $.ajax({
            type: 'post',
            data: {ajax_1: 1,value: value},
            success: function(response)
            {
              if (($('#doctor option').length != 0) || (value == 0)) 
              {
                $('#doctor').empty();
                $('#date').empty();
                $('#time').empty();
              }
              $('#doctor').append(response);
            }
          });
        
      }

      // Function on the onChange of doctor
      function date_list(str)
      {
        var e = document.getElementById("doctor");
        var date = e.options[e.selectedIndex].value;
        var time = e.options[e.selectedIndex].value;
        
        $.ajax({
          type: 'post',
          data: {ajax_2: 1,date: date},
          success: function(response)
          {           
            if (($('#date option').length != 0) || (date == 0)) 
            {
              $('#date').empty();
              $('#time').empty();
            }
            $('#date').append(response);
          }
         });


             $.ajax({
          type: 'post',
          data: {ajax_3: 1,time: time},
          success: function(response){

            $('#time').append(response);
          }
         });  
      }
        
      // Function for activating Book Button
      function activate_btn()
      {
        var date_e = document.getElementById("date").value;
        var time_e = document.getElementById("time").value;

        if (date_e != 0 && time_e != 0) 
        {
            $("input[type='submit']").attr('disabled', false);   
        }
      }
    </script>

  </body>
</html>
