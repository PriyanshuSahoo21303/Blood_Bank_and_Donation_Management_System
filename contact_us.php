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
  $active = 'contact';
  include 'head.php';
  ?>

  <?php
  if (isset($_POST["send"])) {
    $name = $_POST['fullname'];
    $number = $_POST['contactno'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

    $sql = "INSERT INTO contact_query (query_name, query_number, query_mail, query_message) 
              VALUES ('{$name}', '{$number}', '{$email}', '{$message}')";
    $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

    echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <b>Query Sent, We will contact you shortly.</b>
            </div>';
  }
  ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <!-- Main Contact Heading -->
        <h1 class="mt-4 mb-3" data-aos="fade-down">Contact</h1>
        <div class="row">
          <!-- Left Column: Send us a Message Form -->
          <div class="col-lg-8 mb-4" data-aos="fade-right">
            <h3>Send us a Message</h3>
            <form name="sentMessage" method="post">
              <div class="control-group form-group" data-aos="fade-up" data-aos-delay="100">
                <div class="controls">
                  <label>Full Name:</label>
                  <input type="text" class="form-control" id="name" name="fullname" required>
                </div>
              </div>
              <div class="control-group form-group" data-aos="fade-up" data-aos-delay="150">
                <div class="controls">
                  <label>Phone Number:</label>
                  <input type="tel" class="form-control" id="phone" name="contactno" required>
                </div>
              </div>
              <div class="control-group form-group" data-aos="fade-up" data-aos-delay="200">
                <div class="controls">
                  <label>Email Address:</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
              <div class="control-group form-group" data-aos="fade-up" data-aos-delay="250">
                <div class="controls">
                  <label>Message:</label>
                  <textarea rows="10" cols="100" class="form-control" id="message" name="message" required maxlength="999" style="resize:none"></textarea>
                </div>
              </div>
              <!-- Updated submit button with inline style to ensure visibility -->
              <button
                type="submit"
                name="send"
                class="btn btn-primary"
                data-aos="zoom-in"
                data-aos-delay="300"
                style="display:block; width:100%; background-color:#007bff; color:#fff; font-size:1.2em; padding:10px; margin-top:15px;">
                Send Message
              </button>
            </form>
          </div>
          <!-- Right Column: Contact Details -->
          <div class="col-lg-4 mb-4" data-aos="fade-left">
            <h2>Contact Details</h2>
            <?php
            include 'conn.php';
            $sql = "SELECT * FROM contact_info";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <br>
                <p>
                <h4>Address:</h4> <?php echo $row['contact_address']; ?>
                </p>
                <p>
                <h4>Email:</h4> <?php echo $row['contact_mail']; ?>
                </p>
                <p>
                <h4>Contact Number:</h4> <?php echo $row['contact_phone']; ?>
                </p>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </div>
    <?php include('footer.php'); ?>
  </div>

  <!-- Include AOS and GSAP Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script>
    // Initialize AOS with custom options
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });

    // GSAP hover effect for the submit button
    document.querySelector("button[name='send']").addEventListener("mouseenter", function() {
      gsap.to(this, {
        scale: 1.1,
        duration: 0.3
      });
    });
    document.querySelector("button[name='send']").addEventListener("mouseleave", function() {
      gsap.to(this, {
        scale: 1,
        duration: 0.3
      });
    });
  </script>
</body>

</html>