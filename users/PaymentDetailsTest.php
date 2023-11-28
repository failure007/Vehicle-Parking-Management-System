<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PaymentDetailsTest extends TestCase
{
    public function test_valid_booking_id_and_vehicle_id_displayed()
    {
        // Simulate accessing the page with valid booking and vehicle IDs
        $_GET['booking_id'] = 123;
        $_GET['veh_id'] = 456;

        // Execute the code
        include('payment-detail.php');

        // Check if the booking and vehicle IDs are displayed
        $this->expectOutputString('<td align="center">' . $_GET['booking_id'] . '</td>');
        $this->expectOutputString('<td align="center">' . $_GET['veh_id'] . '</td>');
    }

    public function test_invalid_booking_id_redirects_to_my_bookings_page()
    {
        $_GET['booking_id'] = 'invalid_booking_id';
        $_GET['veh_id'] = 456;

        // Execute the code
        include('payment-detail.php');

        // Check if the user is redirected to the my-bookings page
        $this->expectOutputString('<script>window.location.href=\'my-bookings.php\'</script>');
    }

    public function test_invalid_vehicle_id_redirects_to_view_vehicle_details_page()
    {
        $_GET['booking_id'] = 123;
        $_GET['veh_id'] = 'invalid_vehicle_id';

        // Execute the code
        include('payment-detail.php');

        // Check if the user is redirected to the view-vehicle-details page for the specified booking ID
        $this->expectOutputString('<script>window.location.href=\'view-vehicle-details.php?booking_id=123\'</script>');
    }
}
