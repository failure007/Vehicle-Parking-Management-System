<?php

class ViewVehicleListTest extends PHPUnit\Framework\TestCase
{
    public function testGetVehicleList()
    {
        // Arrange
        $user_name = 'test_user';
        $expectedParkingNumbers = ['ABC123', 'DEF456', 'GHI789'];
        $expectedOwnerNames = ['John Doe', 'Jane Doe', 'Peter Jones'];
        $expectedRegistrationNumbers = ['MH01 AB1234', 'MH01 CD5678', 'MH01 EF9012'];

        // Act
        $vehicleList = getVehicleList($user_name);

        // Assert
        $this->assertEquals(count($expectedParkingNumbers), count($vehicleList));

        for ($i = 0; $i < count($expectedParkingNumbers); $i++) {
            $this->assertEquals($expectedParkingNumbers[$i], $vehicleList[$i]['ParkingNumber']);
            $this->assertEquals($expectedOwnerNames[$i], $vehicleList[$i]['OwnerName']);
            $this->assertEquals($expectedRegistrationNumbers[$i], $vehicleList[$i]['RegistrationNumber']);
        }
    }

    public function testGetVehicleListWithInvalidUsername()
    {
        // Arrange
        $user_name = 'invalid_user';
        $expectedVehicleList = null;

        // Act
        $vehicleList = getVehicleList($user_name);

        // Assert
        $this->assertEquals($expectedVehicleList, $vehicleList);
    }
}

function getVehicleList($user_name)
{
    // Simulate database interaction to retrieve vehicle list for the specified user
    $vehicleList = null;

    if ($user_name === 'test_user') {
        $vehicleList = [
            [
                'ParkingNumber' => 'ABC123',
                'OwnerName' => 'John Doe',
                'RegistrationNumber' => 'MH01 AB1234'
            ],
            [
                'ParkingNumber' => 'DEF456',
                'OwnerName' => 'Jane Doe',
                'RegistrationNumber' => 'MH01 CD5678'
            ],
            [
                'ParkingNumber' => 'GHI789',
                'OwnerName' => 'Peter Jones',
                'RegistrationNumber' => 'MH01 EF9012'
            ]
        ];
    }

    return $vehicleList;
}
