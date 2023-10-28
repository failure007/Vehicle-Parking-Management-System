<?php
use PHPUnit\Framework\TestCase;

class AdminProfileTest extends TestCase {
    private $con;
    private $sessionBackup;

    public function setUp(): void {
        // Initialize the database connection and backup the session
        $this->con = mysqli_connect("your_db_host", "your_db_user", "your_db_password", "your_db_name");
        $this->sessionBackup = $_SESSION;
    }

    public function tearDown(): void {
        // Close the database connection and restore the session
        mysqli_close($this->con);
        $_SESSION = $this->sessionBackup;
    }

    public function testValidAdminProfileUpdate() {
        $_SESSION['vpmsaid'] = 1; // Set a valid session

        $_POST['adminname'] = "New Admin Name";
        $_POST['contactnumber'] = "1234567890";

        // Mock the successful database update
        $this->expectQueryUpdateSuccess();

        ob_start(); // Capture output
        include('admin-profile.php');
        $output = ob_get_clean(); // Get the captured output

        // Assert that the success message is displayed
        $this->assertStringContainsString('Admin profile has been updated.', $output);
    }

    public function testInvalidAdminProfileUpdate() {
        $_SESSION['vpmsaid'] = 1; // Set a valid session

        $_POST['adminname'] = "New Admin Name";
        $_POST['contactnumber'] = "1234567890";

        // Mock a failed database update
        $this->expectQueryUpdateFailure();

        ob_start(); // Capture output
        include('admin-profile.php');
        $output = ob_get_clean(); // Get the captured output

        // Assert that an error message is displayed
        $this->assertStringContainsString('Something Went Wrong. Please try again', $output);
    }

    private function expectQueryUpdateSuccess() {
        global $con;
        // Mock a successful database update
        $this->assertEquals(true, mysqli_query($con, $this->isInstanceOf('string')));
    }

    private function expectQueryUpdateFailure() {
        global $con;
        // Mock a failed database update
        $this->assertEquals(false, mysqli_query($con, $this->isInstanceOf('string')));
    }
}
?>
