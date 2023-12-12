<?php

class VehicleEntryFormDisplayTest extends PHPUnit\Framework\TestCase
{
    public function testSuccessfulVehicleEntryFormDisplay()
{
    // Arrange
    $_SESSION['vpmsuid'] = '';

    // Act
    ob_start();
    include('add-vehicle.php');
    $output = ob_get_clean();

    // Assert
    $this->assertContains('<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">', $output);
    $this->assertContains('<label for="select" class=" form-control-label">Select</label>', $output);
    $this->assertContains('<label for="text-input" class=" form-control-label">Vehicle Company</label>', $output);
    $this->assertContains('<label for="text-input" class=" form-control-label">Registration Number</label>', $output);
    $this->assertContains('<label for="text-input" class=" form-control-label">Owner Name</label>', $output);
    $this->assertContains('<label for="text-input" class=" form-control-label">Owner Contact Number</label>', $output);
}
}
