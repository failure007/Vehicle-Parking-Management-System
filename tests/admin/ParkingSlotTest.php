<?php
use PHPUnit\Framework\TestCase;

class ParkingSlotTest extends TestCase {
    public function testSubmitForm() {
        // Simulate session start and set $_SESSION variable
        $_SESSION['vpmsaid'] = 'some_admin_id'; // Simulate logged-in user

        // Simulate POST request data
        $_POST = [
            'no_of_blocks' => 5,
            // Include other necessary fields if applicable
        ];

        // Include the file containing the PHP code
        require 'slot_booking.php'; 

        // Check if the form submission executes without errors
        $this->expectOutputString('<script>alert(\'Parking Level added successfully\');</script>');
    }

    public function testInvalidSessionRedirect() {
        // Simulate session not started and $_SESSION variable not set
        $_SESSION = [];

        // Include the file containing the PHP code
        require 'print.php'; 

        // Check if it redirects to logout.php when session is invalid
        $this->assertContains('location:logout.php', xdebug_get_headers());
    }

}
?>
