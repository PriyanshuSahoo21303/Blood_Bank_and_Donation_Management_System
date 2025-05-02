<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- AOS CSS for scroll animations -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <style>
    /* Add your custom CSS here */
  </style>
</head>

<body>
  <div class="header">
    <?php
      $active = "home";
      include('head.php'); 
    ?>
  </div>
  <?php include 'ticker.php'; ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:75px;">

        <!-- Carousel Section -->
        <div id="demo" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active" data-aos="fade-up">
              <img src="image/Blood-Donation-1.jpg" alt="Blood-Donation-1" width="100%" height="500">
            </div>
            <div class="carousel-item" data-aos="fade-up">
              <img src="image/Blood-facts_10-illustration-graphics__canteen.png" alt="Blood-facts" width="100%" height="500">
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
        <br>
        
        <!-- Page Heading -->
        <h1 style="text-align:center; font-size:45px;" data-aos="zoom-in">
          Welcome to BloodBank & Donation Management System
        </h1>
        <br>

        <!-- Cards Row -->
        <div class="row">
          <div class="col-lg-4 mb-4" data-aos="flip-left">
            <div class="card">
              <h4 class="card-header bg-info text-white">The need for blood</h4>
              <p class="card-body overflow-auto" style="padding-left:2%; height:120px; text-align:left;">
                <?php
                  include 'conn.php';
                  $sql = "select * from pages where page_type='needforblood'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo $row['page_data'];
                    }
                  }
                ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 mb-4" data-aos="flip-right">
            <div class="card">
              <h4 class="card-header bg-info text-white">Blood Tips</h4>
              <p class="card-body overflow-auto" style="padding-left:2%; height:120px; text-align:left;">
                <?php
                  include 'conn.php';
                  $sql = "select * from pages where page_type='bloodtips'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo $row['page_data'];
                    }
                  }
                ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 mb-4" data-aos="zoom-in">
            <div class="card">
              <h4 class="card-header bg-info text-white">Who you could Help</h4>
              <p class="card-body overflow-auto" style="padding-left:2%; height:120px; text-align:left;">
                <?php
                  include 'conn.php';
                  $sql = "select * from pages where page_type='whoyouhelp'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo $row['page_data'];
                    }
                  }
                ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Blood Donor Names Section -->
        <h2 data-aos="fade-right">Blood Donor Names</h2>
        <div class="row">
          <?php
            include 'conn.php';
            $sql = "select * from donor_details join blood where donor_details.donor_blood = blood.blood_id order by rand() limit 6";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-4 col-sm-6 portfolio-item" data-aos="zoom-in"><br>
            <div class="card" style="width:300px">
              <img class="card-img-top" src="image/blood_drop_logo.jpg" alt="Card image" style="width:100%; height:300px">
              <div class="card-body">
                <h3 class="card-title"><?php echo $row['donor_name']; ?></h3>
                <p class="card-text">
                  <b>Blood Group : </b><b><?php echo $row['blood_group']; ?></b><br>
                  <b>Mobile No. : </b><?php echo $row['donor_number']; ?><br>
                  <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                  <b>Age : </b><?php echo $row['donor_age']; ?><br>
                  <b>Address : </b><?php echo $row['donor_address']; ?><br>
                </p>
              </div>
            </div>
          </div>
          <?php 
              }
            }
          ?>
        </div>
        <br>

        <!-- Features Section -->
        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h2>BLOOD GROUPS</h2>
            <p>
              <?php
                include 'conn.php';
                $sql = "select * from pages where page_type='bloodgroups'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }
              ?>
            </p>
          </div>
          <div class="col-lg-6" data-aos="fade-left">
            <img class="img-fluid rounded" src="image/blood_donationcover.jpeg" alt="">
          </div>
        </div>
        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
          <div class="col-md-8" data-aos="zoom-in">
            <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
            <p>
              <?php
                include 'conn.php';
                $sql = "select * from pages where page_type='universal'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }
              ?>
            </p>
          </div>
          <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="donate_blood.php" style="background-color:#7FB3D5; color:#273746" data-aos="flip-up">Become a Donor</a>
          </div>
        </div>
      </div> <!-- end #content-wrap -->
    </div> <!-- end .container -->
    <?php include('footer.php'); ?>
  </div> <!-- end #page-container -->

  <!-- Include AOS and GSAP Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script>
    // Initialize AOS for scroll-based animations
    AOS.init();
    
    // GSAP - Add a click animation to all buttons and elements with .btn class
    document.querySelectorAll("button, .btn").forEach(button => {
      button.addEventListener("click", () => {
        gsap.fromTo(button, { scale: 1 }, { scale: 0.95, duration: 0.2, yoyo: true, repeat: 1 });
      });
    });
  </script>
</body>
</html>