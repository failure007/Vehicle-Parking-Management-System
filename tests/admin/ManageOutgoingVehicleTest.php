<?php
require 'includes/dbconnection.php';

class ManageOutgoingVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testDeleteOutgoingVehicle()
    {
        // Arrange
        $id = 1;

        // Act
        $result = mysqli_query($con, "delete from tblvehicle where ID ='$id'");
        $alertMessage = "<script>alert('Data Deleted');</script>";
        $redirectScript = "<script>window.location.href='manage-outgoingvehicle.php'</script>";

        // Assert
        $this->assertEquals(true, $result);
        $this->assertEquals($alertMessage, $_SERVER['HTTP_HOST'] . '/manage-outgoingvehicle.php');
        $this->assertEquals($redirectScript, $_SERVER['HTTP_HOST'] . '/manage-outgoingvehicle.php');
    }
}
