<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conn.php'; // Ensure database connection is included

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    // Construct SQL query
    $sql = "DELETE FROM contact_query WHERE query_id = $id";

    // Execute query and handle errors
    if (mysqli_query($conn, $sql)) {
        echo "Query deleted successfully.";
        header("Location: query.php"); // Redirect back to the query page
        exit(); // Stop further execution
    } else {
        die("Error deleting query: " . mysqli_error($conn));
    }
} else {
    die("Invalid request. No ID provided.");
}
?>
