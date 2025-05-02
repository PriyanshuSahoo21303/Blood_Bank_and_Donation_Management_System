if ($query_successful) {
    echo "<script>
        alert('Blood Bank Added Successfully.');
        window.location.href = 'bloodbank_list.php';
    </script>";
} else {
    echo "<script>
        alert('Error Adding Blood Bank.');
        window.location.href = 'bloodbank_list.php';
    </script>";
}
