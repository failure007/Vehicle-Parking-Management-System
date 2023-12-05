<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PrintDetailsTest extends TestCase
{
    public function test_vehicle_details_displayed()
    {
        // Simulate accessing the page with a valid vehicle ID
        $_GET['vid'] = 123;

        // Execute the code
        include(__DIR__ . '/../../users/print.php');

        // Check if the vehicle details are displayed
        $this->expectOutputString('<td align="center">' . $_GET['vid'] . '</td>');
    }

    public function test_incoming_vehicle_status_displayed()
    {
        // Simulate accessing the page with a vehicle that has not yet been out
        $_GET['vid'] = 123;

        // Execute the code
        include(__DIR__ . '/../../users/print.php');

        // Check if the vehicle status is displayed as "Incoming Vehicle"
        $this->expectOutputString('<td align="center">Incoming Vehicle</td>');
    }

    public function test_outgoing_vehicle_status_displayed()
    {
        // Simulate accessing the page with a vehicle that has been out
        $_GET['vid'] = 123;
        $_POST['outTime'] = date('Y-m-d H:i:s');

        // Execute the code
        include(__DIR__ . '/../../users/print.php');

        // Check if the vehicle status is displayed as "Outgoing Vehicle"
        $this->expectOutputString('<td align="center">Outgoing Vehicle</td>');
    }
}
