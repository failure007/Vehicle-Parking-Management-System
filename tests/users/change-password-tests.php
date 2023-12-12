<?php

require __DIR__ . '/includes/dbconnection.php';

class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
    {
        // Arrange
        session_start();
        $_SESSION['vpmsuid'] = '';

        // Act
        ob_start();
        include('change-password.php');
        $output = ob_get_clean();

        // Assert
        $this->assertContains('location:logout.php', $output);
    }
}

class PasswordChangeFormDisplayTest extends PHPUnit\Framework\TestCase
{
    public function testSuccessfulPasswordChangeFormDisplay()
    {
        // Arrange
        session_start();
        $_SESSION['vpmsuid'] = '';

        // Act
        ob_start();
        include('change-password.php');
        $output = ob_get_clean();

        // Assert
        $this->assertContains('<form action="" method="post" class="form-horizontal" name="changepassword" onsubmit="return checkpass();">', $output);
        $this->assertContains('<label for="text-input" class=" form-control-label">Current Password</label>', $output);
        $this->assertContains('<label for="email-input" class=" form-control-label">New Password</label>', $output);
        $this->assertContains('<label for="password-input" class=" form-control-label">Confirm Password</label>', $output);
    }
}

// Run the tests
$testSuite = new PHPUnit\Framework\TestSuite();
$testSuite->addTestSuite(AccessControlTest::class);
$testSuite->addTestSuite(PasswordChangeFormDisplayTest::class);
$testSuite->run();
