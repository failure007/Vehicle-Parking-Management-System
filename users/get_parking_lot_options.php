<?php
// Include database connection file
include('includes/dbconnection.php');

// Fetch parking lot options from the database
$query = "SELECT id, name FROM parking_lots";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Output options as HTML select options
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else {
    echo "<option value='' disabled>No parking lots available</option>";
}

// Close database connection
mysqli_close($con);
?>
