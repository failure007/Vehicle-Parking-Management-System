<?php
require 'includes/dbconnection.php';

class ManageIncomingVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testDeleteIncomingVehicle()
    {
        // Arrange
        $id = 1;

        // Act
        $result = mysqli_query($con, "delete from tbbookedslots where id='$id'");
        $alertMessage = "<script>alert('Data Deleted');</script>";
        $redirectScript = "<script>window.location.href='manage-incomingvehicle.php'</script>";

        // Assert
        $this->assertEquals(true, $result);
        $this->assertEquals($alertMessage, $_SERVER['HTTP_HOST'] . '/manage-incomingvehicle.php');
        $this->assertEquals($redirectScript, $_SERVER['HTTP_HOST'] . '/manage-incomingvehicle.php');
    }
}
