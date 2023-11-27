class AddVehicleTest extends PHPUnit\Framework\TestCase
{
    public function testAddVehicle()
    {
        // Arrange
        $vehicleCategory = 'Car';
        $vehicleCompany = 'Toyota';
        $registrationNumber = 'TN 01 AB 1234';
        $ownerName = 'John Doe';
        $ownerContactNumber = '9876543210';
        $parkingNumber = mt_rand(100000000, 999999999);

        // Act
        $con = mysqli_connect('localhost', 'username', 'password', 'database');
        $query = mysqli_query($con, "insert into tblvehicle (user_name, ParkingNumber, VehicleCategory, VehicleCompanyname, RegistrationNumber, OwnerName, OwnerContactNumber) values ('user1', '$parkingNumber', '$vehicleCategory', '$vehicleCompany', '$registrationNumber', '$ownerName', '$ownerContactNumber')");

        // Assert
        $this->assertTrue($query);

        mysqli_close($con);
    }
}
