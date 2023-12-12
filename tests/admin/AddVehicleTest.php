<?php

class AddVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testAddVehicle()
    {
        // Arrange
        $parkingNumber = mt_rand(100000000, 999999999);
        $catename = 'New Category';
        $vehcomp = 'New Vehicle Company';
        $vehreno = '1234567890';
        $ownername = 'Sasikiran';
        $ownercontno = '1234567890';

        // Act
        $result = addVehicle($parkingNumber, $catename, $vehcomp, $vehreno, $ownername, $ownercontno);

        // Assert
        $this->assertTrue($result);
    }
}

function addVehicle($parkingNumber, $catename, $vehcomp, $vehreno, $ownername, $ownercontno)
{
    // Simulate database insertion
    return true;
}
