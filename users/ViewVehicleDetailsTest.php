<?php

class ViewVehicleDetailsTest extends PHPUnit\Framework\TestCase
{
    public function testGetVehicleDetails()
    {
        // Arrange
        $vehicleId = 1;
        $expectedParkingNumber = 'ABC123';
        $expectedVehicleCategory = 'Car';
        $expectedVehicleCompanyName = 'Toyota';
        $expectedRegistrationNumber = 'DEF456';
        $expectedOwnerName = 'Dheeraj Kumar';
        $expectedOwnerContactNumber = '1234567890';
        $expectedInTime = '2023-11-27 10:20:00';
        $expectedStatus = 'In';

        // Act
        $vehicleDetails = getVehicleDetails($vehicleId);

        // Assert
        $this->assertEquals($expectedParkingNumber, $vehicleDetails['ParkingNumber']);
        $this->assertEquals($expectedVehicleCategory, $vehicleDetails['VehicleCategory']);
        $this->assertEquals($expectedVehicleCompanyName, $vehicleDetails['VehicleCompanyname']);
        $this->assertEquals($expectedRegistrationNumber, $vehicleDetails['RegistrationNumber']);
        $this->assertEquals($expectedOwnerName, $vehicleDetails['OwnerName']);
        $this->assertEquals($expectedOwnerContactNumber, $vehicleDetails['OwnerContactNumber']);
        $this->assertEquals($expectedInTime, $vehicleDetails['InTime']);
        $this->assertEquals($expectedStatus, $vehicleDetails['Status']);
    }

    public function testGetVehicleDetailsWithInvalidVehicleId()
    {
        // Arrange
        $vehicleId = 1000; // Invalid vehicle ID
        $expectedVehicleDetails = null;

        // Act
        $vehicleDetails = getVehicleDetails($vehicleId);

        // Assert
        $this->assertEquals($expectedVehicleDetails, $vehicleDetails);
    }
}

function getVehicleDetails($vehicleId)
{
    // Simulate database interaction to retrieve vehicle details
    $vehicleDetails = null;

    if ($vehicleId > 0) {
        $vehicleDetails = [
            'ParkingNumber' => 'ABC123',
            'VehicleCategory' => 'Car',
            'VehicleCompanyname' => 'Toyota',
            'RegistrationNumber' => 'DEF456',
            'OwnerName' => 'Dheeraj Kumar',
            'OwnerContactNumber' => '1234567890',
            'InTime' => '2023-11-27 10:20:00',
            'Status' => 'In'
        ];
    }

    return $vehicleDetails;
}
