<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- AOS CSS for scroll animations -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
  $active = 'donate';
  include('head.php');
?>

<div id="page-container" style="margin-top:50px; position: relative; min-height:84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <!-- Page Heading -->
      <div class="row" data-aos="fade-down">
        <div class="col-lg-6">
          <h1 class="mt-4 mb-3" data-aos="fade-down">Donate Blood</h1>
        </div>
      </div>
      
      <form name="donor" action="savedata.php" method="post">
        <!-- First Row: Full Name, Mobile Number, Email Id -->
        <div class="row" data-aos="fade-up">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Full Name<span style="color:red">*</span></div>
            <div>
              <input type="text" name="fullname" class="form-control" required>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
            <div>
              <input type="text" name="mobileno" class="form-control" required>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Email Id</div>
            <div>
              <input type="email" name="emailid" class="form-control">
            </div>
          </div>
        </div>
        
        <!-- Second Row: Age, Gender, Blood Group -->
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Age<span style="color:red">*</span></div>
            <div>
              <input type="text" name="age" class="form-control" required>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Gender<span style="color:red">*</span></div>
            <div>
              <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Blood Group<span style="color:red">*</span></div>
            <div>
              <select name="blood" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php
                  include 'conn.php';
                  $sql = "select * from blood";
                  $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                  while($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value=" <?php echo $row['blood_id'] ?>">
                  <?php echo $row['blood_group'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Third Row: Address -->
        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Address<span style="color:red">*</span></div>
            <div>
              <textarea class="form-control" name="address" required></textarea>
            </div>
          </div>
        </div>
        
        <!-- Fourth Row: Submit Button -->
        <div class="row" data-aos="zoom-in" data-aos-delay="300">
          <div class="col-lg-4 mb-4">
            <div>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer">
            </div>
          </div>
        </div>
      </form>
    </div> <!-- end content-wrap -->
  </div> <!-- end container -->
  
  <?php include('footer.php') ?>
</div> <!-- end page-container -->

<!-- Include AOS and GSAP Scripts -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
  // Initialize AOS for scroll animations
  AOS.init();

  // GSAP - Add a subtle hover effect for the submit button
  document.querySelectorAll("input[type=submit]").forEach(function(button) {
    button.addEventListener("mouseenter", function() {
      gsap.to(button, { scale: 1.05, duration: 0.3 });
    });
    button.addEventListener("mouseleave", function() {
      gsap.to(button, { scale: 1, duration: 0.3 });
    });
  });
</script>
</body>
</html>