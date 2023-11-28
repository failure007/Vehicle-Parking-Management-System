class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
    {
        // Arrange
        $_SESSION['vpmsaid'] = '';

        // Start session for the specific test case
        session_start();

        // Act
        ob_start();
        include('add-vehicle.php');
        $output = ob_get_clean();

        // Close the session to prevent "headers already sent" issue
        session_write_close();

        // Assert
        $this->assertContains('location:logout.php', $output);
    }
}
