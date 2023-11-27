<?php

class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
{
    // Arrange
    $_SESSION['vpmsaid'] = '';

    // Act
    ob_start();
    include('add-vehicle.php');
    $output = ob_get_clean();

    // Assert
    $this->assertContains('location:logout.php', $output);
}
}
