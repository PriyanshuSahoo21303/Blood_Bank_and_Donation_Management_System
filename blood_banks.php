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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
        background: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    h1, h2 {
        text-align: center;
        color: #343a40;
    }
    .description-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin-bottom: 40px;
    }
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    p {
        text-align: justify;
        line-height: 1.8;
    }
    #page-container {
        position: relative;
        min-height: 100vh; /* Ensures the page height spans the full viewport */
    }
    #content-wrap {
        padding-bottom: 100px; /* Prevents overlap with the footer */
    }
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px; /* Height of the footer */
        background-color: #343a40;
        color: white;
        text-align: center;
        line-height: 50px; /* Vertically centers text */
    }
  </style>
</head>
<body>

  <?php 
    $active = 'available_blood_banks';
    include('head.php');
  ?>

  <div id="page-container">
    <div id="content-wrap">
      <div class="container">
        
        <!-- Heading Section -->
        <div class="row">
          <div class="col-lg-12">
            <!-- Added fade-down animation on scroll -->
            <h1 class="mt-4 mb-3" data-aos="fade-right">Blood Banks</h1>
          </div>
        </div>
        
        <!-- Description Section -->
        <div class="row">
          <div class="col-lg-12">
            <!-- Added fade-up animation on scroll -->
            <div class="description-container" data-aos="fade-up">
              <p>
                Blood banks play a vital role in saving lives by ensuring a steady supply of blood and its components for those in need. They serve as essential facilities where blood is collected, tested, stored, and distributed. Blood banks provide life-saving support during medical emergencies, surgeries, accidents, and treatments for conditions like anemia, cancer, and severe infections. By maintaining an organized inventory of blood types, including rare ones, they ensure that hospitals and healthcare providers have access to the required resources in critical situations.
              </p>
              <p>
                Voluntary donations are the backbone of blood banks, and public awareness campaigns often encourage healthy individuals to donate blood regularly. Each donation is meticulously screened and processed to meet stringent safety and quality standards. Modern blood banks also separate donations into components such as red blood cells, plasma, and platelets, catering to diverse medical needs. By ensuring timely availability of blood, these institutions uphold the principles of humanity and compassion, often serving as a beacon of hope for countless lives in their darkest hours.
              </p>
            </div>
          </div>
        </div>
        
        <!-- Table Section -->
        <div class="row">
          <div class="col-lg-12">
            <!-- Table container will fade up into view -->
            <div class="table-container" data-aos="fade-up">
              <h2 class="text-center" data-aos="zoom-in">Available Blood Banks</h2>
              <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th>Sl. No</th>
                    <th>Blood Bank Name</th>
                    <th>Contact Number</th>
                    <th>Contact Mail</th>
                    <th>Available Blood Groups</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include 'conn.php';
                    $sql = "SELECT * FROM blood_banks";
                    $result = mysqli_query($conn, $sql);
                    $sl_no = 1;

                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $sl_no++ . "</td>";  // DO NOT ALTER SQL CODE
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['contact_mail']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['available_blood_groups']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='6' class='text-center'>No blood banks found.</td></tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>

    <?php include('footer.php') ?>
  </div>

  <!-- Include AOS and GSAP Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script>
    // Initialize AOS for scroll-based animations
    AOS.init();

    // GSAP - Add a click animation to all buttons and .btn elements
    document.querySelectorAll("button, .btn").forEach(button => {
      button.addEventListener("click", () => {
        gsap.fromTo(button, { scale: 1 }, { scale: 0.95, duration: 0.2, yoyo: true, repeat: 1 });
      });
    });

    // GSAP - Add hover animations for header buttons if they have the class .header-btn in head.php
    document.querySelectorAll(".header-btn").forEach(button => {
      button.addEventListener("mouseenter", () => {
        gsap.to(button, { scale: 1.1, duration: 0.5 });
      });
      button.addEventListener("mouseleave", () => {
        gsap.to(button, { scale: 1, duration: 0.5 });
      });
    });
  </script>
</body>
</html>