<?php
include 'conn.php'; // Include your database connection

// Get the blood bank ID from the URL
$bloodbank_id = $_GET['id'];

// SQL query to delete the blood bank record
$sql = "DELETE FROM blood_banks WHERE id={$bloodbank_id}";
$result = mysqli_query($conn, $sql);

// Redirect to the blood bank list page
header("Location: bloodbank_list.php");

// Close the database connection
mysqli_close($conn);
?>
