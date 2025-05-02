<?php 
include 'session.php'; 
$active = 'update_bloodbanks'; // Set the correct active state
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    #sidebar { position: relative; margin-top: -20px; }
    #content { position: relative; margin-left: 210px; }
    @media screen and (max-width: 600px) {
      #content {
        position: relative; margin-left: auto; margin-right: auto;
      }
    }
  </style>
</head>
<body style="background-image: url('admin_image/close-up-red-water-drops-table.jpg'); 
             background-size: cover; 
             background-position: center; 
             background-repeat: no-repeat; 
             background-attachment: fixed; 
             color: black;">
<?php
include 'conn.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect form data
        $bloodbankname = $_POST['bloodbankname'];
        $contactno = $_POST['contactno'];
        $emailid = isset($_POST['emailid']) ? $_POST['emailid'] : null; // Optional field
        $location = $_POST['location'];
        $bloodgroups = $_POST['bloodgroups'];

        // Insert data into the 'blood_banks' table
        $sql = "INSERT INTO blood_banks (name, contact_number, contact_mail, available_blood_groups, location) 
                VALUES ('$bloodbankname', '$contactno', '$emailid', '$bloodgroups', '$location')";
        
        if (mysqli_query($conn, $sql)) {
            // Redirect to the "Blood Bank List" page after successful insertion
            header("Location: bloodbank_list.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
?>
<div id="header">
  <?php $active = "update_bloodbanks"; include 'header.php'; ?>
</div>
<div id="sidebar">
  <?php include 'sidebar.php'; ?>
</div>
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <h1 class="page-title" style="color: white;">Update Blood Bank</h1>
        </div>
      </div>
      <hr>
      <form name="bloodbank" method="post">
        <div class="row">
          <div class="col-lg-4 mb-4"><br>
            <div class="font-italic" style="color:white;">Blood Bank Name<span style="color:red">*</span></div>
            <div><input type="text" name="bloodbankname" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4"><br>
            <div class="font-italic" style="color:white;">Contact Number<span style="color:red">*</span></div>
            <div><input type="text" name="contactno" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4"><br>
            <div class="font-italic" style="color:white;">Email Id</div>
            <div><input type="email" name="emailid" class="form-control"></div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 mb-4"><br>
            <div class="font-italic" style="color:white;">Location<span style="color:red">*</span></div>
            <div><input type="text" name="location" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4"><br>
            <div class="font-italic" style="color:white;">Available Blood Groups<span style="color:red">*</span></div>
            <div><textarea name="bloodgroups" class="form-control" rows="3" required></textarea></div>
          </div>
        </div>
        
        <br>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div><input type="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
} else {
    echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>'; ?>
    <form method="post" action="login.php" class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4" style="float:left">
          <button class="btn btn-primary" type="submit">Go to Login Page</button>
        </div>
      </div>
    </form>
<?php } ?>
</body>
</html>
