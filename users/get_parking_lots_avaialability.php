<?php
// Include database connection file
include('includes/dbconnection.php');

// Fetch parking lots availability from the database
$query = "SELECT * FROM parking_lots";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Output data as a table
    echo "<table border='1'>
            <tr>
                <th>Parking Lot</th>
                <th>Availability</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['availability']}</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No parking lots found.";
}

// Close database connection
mysqli_close($con);
?>
