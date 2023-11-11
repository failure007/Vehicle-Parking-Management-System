<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lots</title>

    <!-- Include Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

    <style>
        /* Add  custom styles here */
    </style>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!--  JavaScript for real-time availability and reservation -->
    <script>
        // Function to fetch and update parking lots availability
        function updateParkingLotsAvailability() {
            // Make an AJAX request to fetch availability data
            $.ajax({
                url: 'get_parking_lots_availability.php', // Replace with the actual file path
                type: 'GET',
                success: function (data) {
                    // Update the content of the #parkingLotsAvailability div
                    $('#parkingLotsAvailability').html(data);
                }
            });
        }

        // Function to fetch and populate parking lot options
        function populateParkingLotOptions() {
            // Make an AJAX request to fetch parking lot options
            $.ajax({
                url: 'get_parking_lot_options.php', // Replace with the actual file path
                type: 'GET',
                success: function (data) {
                    // Populate the #parkingLot select element with options
                    $('#parkingLot').html(data);
                }
            });
        }

        // Function to handle parking lot reservation
        function reserveParkingLot() {
            // Get the selected parking lot
            var selectedParkingLot = $('#parkingLot').val();

            // Make an AJAX request to handle the reservation
            $.ajax({
                url: 'reserve_parking_lot.php', // Replace with the actual file path
                type: 'POST',
                data: { parkingLot: selectedParkingLot },
                success: function (response) {
                    // Handle the response (e.g., show a success message)
                    alert(response);
                }
            });
        }

        // Call the functions initially and set intervals for regular updates
        populateParkingLotOptions();
        updateParkingLotsAvailability();
        setInterval(updateParkingLotsAvailability, 5000); // Update every 5 seconds (adjust as needed)
    </script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Parking Lots Availability</h4>
                        <div id="parkingLotsAvailability">
                            <!-- Display parking lot availability dynamically here -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reserve Parking Lot</h4>
                        <form id="reservationForm">
                            <!-- Display parking lot options dynamically here -->
                            <label for="parkingLot">Select Parking Lot:</label>
                            <select id="parkingLot" name="parkingLot">
                                <!-- Options will be populated dynamically using JavaScript -->
                                <option value="" disabled selected>Loading options...</option>
                            </select>
                            <br>
                            <button type="button" onclick="reserveParkingLot()">Reserve Parking Lot</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (adjust the path if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

    <!-- Include additional HTML content and scripts  -->

</body>
</html>
