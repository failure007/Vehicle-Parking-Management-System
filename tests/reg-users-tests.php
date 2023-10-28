<?php
use PHPUnit\Framework\TestCase;

class RegUsersTest extends TestCase {
    private $con;
    private $sessionBackup;
    private $output;

    public function setUp(): void {
        // Initialize the database connection and backup the session
        $this->con = mysqli_connect("your_db_host", "your_db_user", "your_db_password", "your_db_name");
        $this->sessionBackup = $_SESSION;
        ob_start(); // Capture output
    }

    public function tearDown(): void {
        // Close the database connection and restore the session
        mysqli_close($this->con);
        $_SESSION = $this->sessionBackup;
        $this->output = ob_get_clean(); // Get the captured output
    }

    public function testDeleteUserSuccess() {
        $_SESSION['vpmsaid'] = 1; // Set a valid session
        $_GET['del'] = 1; // Simulate deleting a user with ID 1

        // Mock the successful database deletion
        $this->expectQueryDeleteSuccess();

        include('reg-users.php');

        // Assert that the success message is displayed
        $this->assertStringContainsString('Data Deleted', $this->output);
    }

    public function testDeleteUserFailure() {
        $_SESSION['vpmsaid'] = 1; // Set a valid session
        $_GET['del'] = 1; // Simulate deleting a user with ID 1

        // Mock a failed database deletion
        $this->expectQueryDeleteFailure();

        include('reg-users.php');

        // Assert that an error message is displayed
        $this->assertStringContainsString('Something Went Wrong', $this->output);
    }

    private function expectQueryDeleteSuccess() {
        global $con;
        // Mock a successful database deletion
        $this->assertEquals(true, mysqli_query($con, $this->isInstanceOf('string')));
    }

    private function expectQueryDeleteFailure() {
        global $con;
        // Mock a failed database deletion
        $this->assertEquals(false, mysqli_query($con, $this->isInstanceOf('string')));
    }
}
?>
