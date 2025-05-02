<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- AOS CSS for animations -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <?php 
    $active = 'need';
    include('head.php');
  ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <!-- Heading Section with new animation -->
        <div class="row" data-aos="zoom-in-up">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Need Blood</h1>
          </div>
        </div>
        
        <!-- Form Section -->
        <form name="needblood" action="" method="post">
          <div class="row" data-aos="flip-up">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <div>
                <select name="blood" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <?php
                    include 'conn.php';
                    $sql = "SELECT * FROM blood";
                    $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <option value="<?php echo $row['blood_id']; ?>"><?php echo $row['blood_group']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-lg-4 mb-4" data-aos="flip-down">
              <div class="font-italic">Reason, why do you need blood?<span style="color:red">*</span></div>
              <div>
                <textarea class="form-control" name="address" required></textarea>
              </div>
            </div>
          </div>
          
          <div class="row" data-aos="slide-up">
            <div class="col-lg-4 mb-4">
              <div>
                <input type="submit" name="search" class="btn btn-primary" value="Search" style="cursor:pointer">
              </div>
            </div>
          </div>
        </form>
        
        <?php 
        if (isset($_POST['search'])) {
          $bg = $_POST['blood']; // Blood group ID from the form

          // Fetch Available Blood Banks
          $sql_banks = "
            SELECT * 
            FROM blood_banks
            WHERE FIND_IN_SET(
              (SELECT TRIM(blood_group) FROM blood WHERE blood.blood_id = {$bg}), 
              REPLACE(available_blood_groups, ' ', '')
            ) > 0";
          $result_banks = mysqli_query($conn, $sql_banks) or die("Query failed: " . mysqli_error($conn));

          // Display Blood Banks
          if (mysqli_num_rows($result_banks) > 0) {
            echo '<h2 data-aos="fade-right">Available Blood Banks</h2>';
            echo '<table class="table table-bordered" data-aos="fade-right">';
            echo '<thead><tr><th>Blood Bank Name</th><th>Location</th><th>Contact Number</th></tr></thead>';
            echo '<tbody>';
            while ($row_banks = mysqli_fetch_assoc($result_banks)) {
              echo '<tr>';
              echo '<td>' . $row_banks['name'] . '</td>';
              echo '<td>' . $row_banks['location'] . '</td>';
              echo '<td>' . $row_banks['contact_number'] . '</td>';
              echo '</tr>';
            }
            echo '</tbody></table>';
          } else {
            echo '<div class="alert alert-danger" data-aos="fade-in">No Blood Banks Found For Your Search.</div>';
          }

          // Fetch Donors
          $sql_donors = "
            SELECT * 
            FROM donor_details 
            JOIN blood ON donor_details.donor_blood = blood.blood_id 
            WHERE donor_details.donor_blood = {$bg} 
            ORDER BY RAND() LIMIT 5";
          $result_donors = mysqli_query($conn, $sql_donors) or die("Query failed: " . mysqli_error($conn));

          // Display Donors
          if (mysqli_num_rows($result_donors) > 0) {
            echo '<h2 data-aos="fade-left">Available Donors</h2>';
            echo '<div class="row" data-aos="fade-left">';
            while ($row_donors = mysqli_fetch_assoc($result_donors)) {
              ?>
              <div class="col-lg-4 col-sm-6 portfolio-item" data-aos="flip-left"><br>
                <div class="card" style="width:300px">
                  <img class="card-img-top" src="image/blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px">
                  <div class="card-body">
                    <h3 class="card-title"><?php echo $row_donors['donor_name']; ?></h3>
                    <p class="card-text">
                      <b>Blood Group: </b><b><?php echo $row_donors['blood_group']; ?></b><br>
                      <b>Mobile No.: </b><?php echo $row_donors['donor_number']; ?><br>
                      <b>Gender: </b><?php echo $row_donors['donor_gender']; ?><br>
                      <b>Age: </b><?php echo $row_donors['donor_age']; ?><br>
                      <b>Address: </b><?php echo $row_donors['donor_address']; ?><br>
                    </p>
                  </div>
                </div>
              </div>
              <?php
            }
            echo '</div>';
          } else {
            echo '<div class="alert alert-danger" data-aos="fade-in">No Donor Found For Your Search Blood Group.</div>';
          }
        } 
        ?>
      </div>
    </div>
    <?php include('footer.php'); ?>
  </div>

  <!-- Include AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800, // global duration for animations
      easing: 'ease-in-out',
      once: true   // whether animation should happen only once
    });
  </script>
</body>
</html>