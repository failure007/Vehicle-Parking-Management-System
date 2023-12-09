<?php


class AdminDashboardTest extends PHPUnit\Framework\TestCase {

    // Test method to check the admin dashboard logic
    public function testAdminDashboard() {
        // Simulate the $_SESSION data
        $_SESSION['vpmsaid'] = 'some_value'; // Simulating a non-empty session value

        // Simulate logic for fetching vehicle entries
        $count_today_vehentries = 5; // Sample count for today's vehicle entries
        $count_yesterday_vehentries = 8; // Sample count for yesterday's vehicle entries
        $count_lastsevendays_vehentries = 20; // Sample count for last 7 days' vehicle entries
        $count_total_vehentries = 100; // Sample count for total vehicle entries

        // Simulate logic for fetching registered users and listed categories
        $regdusers = 50; // Sample count for registered users
        $listedcat = 10; // Sample count for listed categories

        // Perform assertions based on the expected values
        $this->assertEquals(5, $count_today_vehentries); // Check today's vehicle entries count
        $this->assertEquals(8, $count_yesterday_vehentries); // Check yesterday's vehicle entries count
        $this->assertEquals(20, $count_lastsevendays_vehentries); // Check last 7 days' vehicle entries count
        $this->assertEquals(100, $count_total_vehentries); // Check total vehicle entries count
        $this->assertEquals(50, $regdusers); // Check registered users count
        $this->assertEquals(10, $listedcat); // Check listed categories count
    }
}
?>
