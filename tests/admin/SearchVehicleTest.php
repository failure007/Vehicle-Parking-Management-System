<?php

class SearchVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testSearchVehicleByParkingNumber()
    {
        // Arrange
        $parkingNumber = '123456';

        // Act
        $results = searchVehicle($parkingNumber);

        // Assert
        $this->assertNotEmpty($results);
        $this->assertEquals($parkingNumber, $results[0]['ParkingNumber']);
    }
}
