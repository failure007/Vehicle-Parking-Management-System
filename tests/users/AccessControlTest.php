<?php

class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
    {
        // Arrange
        $_SESSION['vpmsuid'] = '';

        // Act
        include(__DIR__ . '/../../users/add-vehicle.php');
        

        // Assert
        $this->assertContains('location:logout.php', $output);
    }
}
