<?php
// Include database connection file
include('includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected parking lot ID from the POST data
    $selectedParkingLot = $_POST['parkingLot'];

    // Check if the selected parking lot is available
    $checkAvailabilityQuery = "SELECT id, name, availability FROM parking_lots WHERE id = '$selectedParkingLot'";
    $result = mysqli_query($con, $checkAvailabilityQuery);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $availability = $row['availability'];

        if ($availability > 0) {
            // Decrease the availability of the selected parking lot by 1
            $updateAvailabilityQuery = "UPDATE parking_lots SET availability = availability - 1 WHERE id = '$selectedParkingLot'";
            mysqli_query($con, $updateAvailabilityQuery);


            echo "Parking lot reserved successfully!";
        } else {
            echo "Parking lot is not available for reservation.";
        }
    } else {
        echo "Invalid parking lot selected.";
    }
} else {
    echo "Invalid request method.";
}

// Close database connection
mysqli_close($con);
?>
