<?php

class ViewVehicleListTest extends PHPUnit\Framework\TestCase
{
    public function testGetVehicleList()
    {
        // Arrange
        $user_name = 'test_user';
        $expectedParkingNumbers = ['73264782632', '732467382623', '892348238'];
        $expectedOwnerNames = ['sasikiran', 'dheeraj', 'karthik'];
        $expectedRegistrationNumbers = ['78364326872', '87264782364726', '829346823'];

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
                'ParkingNumber' => '7836483832780',
                'OwnerName' => 'Sasikiran',
                'RegistrationNumber' => '7823647823648'
            ],
            [
                'ParkingNumber' => '78362807436',
                'OwnerName' => 'dheeraj',
                'RegistrationNumber' => '72367862380'
            ],
            [
                'ParkingNumber' => '7238672360',
                'OwnerName' => 'Karthik',
                'RegistrationNumber' => '78436783260823'
            ]
        ];
    }

    return $vehicleList;
}
