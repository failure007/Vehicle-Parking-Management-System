<?php

class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
    {
        // Arrange
        $_SESSION['vpmsuid'] = '';

        // Act
        ob_start();
        session_start(); // Start the session
        session_write_close(); // Close the session immediately
        include(__DIR__ . '/../../users/add-vehicle.php');
        $output = ob_get_clean();

        // Assert
        $this->assertContains('location:logout.php', $output);
    }
}
