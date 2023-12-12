<?php

class UpdateVehicleDetailsTest extends PHPUnit\Framework\TestCase
{
    public function testSuccessfulVehicleDetailsUpdate()
{
    // Arrange
    $_SESSION['vpmsaid'] = '';
    $_GET['viewid'] = 1;
    $_POST['remark'] = 'Test remark';
    $_POST['status'] = 'Out';
    $_POST['parkingcharge'] = '100';

    // Act
    include('view-vehicle-detail.php');

    // Assert
    $vehicle = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tblvehicle WHERE ID = 1"));
    $this->assertEquals($_POST['remark'], $vehicle['Remark']);
    $this->assertEquals($_POST['status'], $vehicle['Status']);
    $this->assertEquals($_POST['parkingcharge'], $vehicle['ParkingCharge']);
}
}
