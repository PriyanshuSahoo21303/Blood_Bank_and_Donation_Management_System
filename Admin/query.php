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
      #content { position: relative; margin-left: auto; margin-right: auto; }
    }
    #he {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
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
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conn.php';
include 'session.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
  <div id="header">
    <?php include 'header.php'; ?>
  </div>
  <div id="sidebar">
    <?php $active = "query"; include 'sidebar.php'; ?>
  </div>
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title"style="color: white;">User Query</h1>
          </div>
        </div>
        <hr>

        <?php
        // Fetch data with pagination
        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM contact_query LIMIT {$offset}, {$limit}";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
          echo '<div class="alert alert-danger">Error fetching data: ' . mysqli_error($conn) . '</div>';
        } elseif (mysqli_num_rows($result) > 0) {
        ?>
          <div class="table-responsive">
          <table class="table table-bordered" style="text-align: center; 
                                           background: rgba(255, 255, 255, 0.5); 
                                           backdrop-filter: blur(5px); 
                                           -webkit-backdrop-filter: blur(10px); 
                                           border-radius: 10px; 
                                           box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">

              <thead>
                <tr>
                  <th>S.no</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>Mobile Number</th>
                  <th>Message</th>
                  <th>Posting Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = $offset + 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['query_name']; ?></td>
                    <td><?php echo $row['query_number']; ?></td>
                    <td><?php echo $row['query_mail']; ?></td>
                    <td><?php echo $row['query_message']; ?></td>
                    <td><?php echo $row['query_date']; ?></td>
                    <td>
                      <?php if ($row['query_status'] == 1) { ?>
                        <span class="label label-success">Read</span>
                      <?php } else { ?>
                        <a href="query.php?id=<?php echo $row['query_id']; ?>" onclick="return clickme()">Read</a>
                      <?php } ?>
                    </td>
                    <td id="he">
                      <a style="background-color:aqua" href='delete_query.php?id=<?php echo $row['query_id']; ?>'>Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php
        } else {
          echo '<div class="alert alert-info">No queries found.</div>';
        }
        ?>

        <div class="pagination-wrapper text-center">
          <?php
          $sql1 = "SELECT COUNT(*) AS total FROM contact_query";
          $result1 = mysqli_query($conn, $sql1);
          $row = mysqli_fetch_assoc($result1);
          $total_records = $row['total'];
          $total_page = ceil($total_records / $limit);

          echo '<ul class="pagination">';
          for ($i = 1; $i <= $total_page; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo '<li class="' . $active . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
          }
          echo '</ul>';
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
  echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
?>
  <form method="post" action="login.php" class="form-horizontal">
    <div class="form-group">
      <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
    </div>
  </form>
<?php } ?>
<script>
  function clickme() {
    return confirm("Do you really want to mark this as Read?");
  }
</script>
</body>
</html>
