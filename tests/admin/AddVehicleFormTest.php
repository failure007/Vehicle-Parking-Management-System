<?php

class AddVehicleFormTest extends PHPUnit\Framework\TestCase
{
    public function testSuccessfulVehicleAddition()
{
    // Arrange
    $_POST['ParkingNumber'] = '3287328';
    $_POST['OwnerName'] = 'Sasikiran';
    $_POST['VehicleRegNumber'] = '83468329';
    $_POST['ContactNumber'] = '9876543210';

    // Act
    include('add-vehicle.php');

    // Assert
    $vehicleId = mysqli_insert_id($con);
    $this->assertGreaterThan(0, $vehicleId);

    // Clean up
    mysqli_query($con, "DELETE FROM tblvehicle WHERE ID = $vehicleId");
}
}
