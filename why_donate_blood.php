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
    $active = 'why';
    include('head.php');
  ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <div class="row">
          <!-- Left Column: Text Content -->
          <div class="col-lg-6" data-aos="fade-right">
            <!-- Heading with fade-down effect -->
            <h1 class="mt-4 mb-3" data-aos="fade-down">Why Should I Donate Blood?</h1>
            <!-- Paragraph with fade-up effect -->
            <p data-aos="fade-up">
              <?php
                include 'conn.php';
                $sql = "select * from pages where page_type='donor'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }
              ?>
            </p>
          </div>
          <!-- Right Column: Image -->
          <div class="col-lg-6" data-aos="fade-left">
            <img class="img-fluid rounded" src="image/08f2fccc45d2564f74ead4a6d5086871.png" style="height:600px; width:500px" alt="error">
          </div>
        </div>
      </div>
    </div>
    
    <?php include('footer.php') ?>
  </div>

  <!-- Include AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    // Initialize AOS for scroll animations
    AOS.init();
  </script>
</body>
</html>