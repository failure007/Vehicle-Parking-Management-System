<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ViewVehicleParkingDetailsTest extends TestCase
{
    public function test_session_active_and_user_logged_in()
    {
        // Simulate an active session with a logged-in user
        $_SESSION['vpmsuid'] = 'valid_user_id';

        // Execute the code
        include('my-bookings.php');

        // Check if the page is displayed for a logged-in user
        $this->expectOutputString('<div class="breadcrumbs">');
    }

    public function test_session_inactive_and_redirected_to_login()
    {
        // Simulate an inactive session
        unset($_SESSION['vpmsuid']);

        // Execute the code
        include('my-bookings.php');

        // Check if the user is redirected to the login page
        $this->expectOutputString('Location: login.php');
    }

    public function test_user_bookings_displayed()
    {
        // Simulate an active session with a logged-in user
        $_SESSION['vpmsumn'] = 'valid_user_name';

        // Mock the database query to return two booking records
        $bookingRecords = [
            [
                'booking_id' => 123,
                'check_in' => '2023-11-27 10:00:00',
                'floor_level' => 2,
                'booked_slot' => 'A1',
                'ParkingNumber' => 'PB-1234',
                'OwnerName' => 'Dheeraj Kumar',
                'RegistrationNumber' => 'ABC-1234',
            ],
            [
                'booking_id' => 456,
                'check_in' => '2023-11-27 14:00:00',
                'floor_level' => 3,
                'booked_slot' => 'B2',
                'ParkingNumber' => 'PB-5678',
                'OwnerName' => 'Karthik Reddy',
                'RegistrationNumber' => 'DEF-4321',
            ],
        ];

        // Mock the database query results
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->any())
                        ->method('query')
                        ->willReturn($bookingRecords);

        // Replace the global database connection with the mock object
        global $con;
        $con = $mockDbConnection;

        // Execute the code
        include('my-bookings.php');

        // Check if the booking records are displayed in the table
        $this->expectOutputString('<td>PB-1234</td>');
        $this->expectOutputString('<td>John Doe</td>');
        $this->expectOutputString('<td>ABC-1234</td>');
        $this->expectOutputString('<td>B2-A1</td>');
        $this->expectOutputString('<td>2023-11-27 10:00:00</td>');
        $this->expectOutputString('<td>PB-5678</td>');
        $this->expectOutputString('<td>Jane Doe</td>');
        $this->expectOutputString('<td>DEF-4321</td>');
        $this->expectOutputString('<td>B3-B2</td>');
        $this->expectOutputString('<td>2023-11-27 14:00:00</td>');
    }
}
