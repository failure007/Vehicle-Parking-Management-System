<?php

class PrintOutgoingVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testPrintOutgoingVehicle()
    {
        // Arrange
        $id = 1;

        // Act
        $result = mysqli_query($con, "select * from tblvehicle where ID='$id'");
        $cnt=1;
        $row=mysqli_fetch_array($result);

        // Assert
        $this->assertEquals(true, $result);
        $this->assertEquals('Incoming Vehicle', $row['Status']);
        $this->assertEquals('8329892332', $row['RegistrationNumber']);
        $this->assertEquals('Dheeraj', $row['OwnerName']);
        $this->assertEquals('328489237489', $row['OwnerContactNumber']);
        $this->assertEquals('2023-11-26 10:00:00', $row['InTime']);
    }
}
