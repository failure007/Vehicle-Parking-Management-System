<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ResetPasswordTest extends TestCase
{
    public function test_password_reset_success_message()
    {
        // Simulate submitting the form with valid credentials
        $_POST['newpassword'] = 'newPassword';
        $_POST['confirmpassword'] = 'newPassword';

        // Execute the code
        include(__DIR__ . '/../../users/reset-password.php');

        // Check if the password reset success message is displayed
        $this->expectOutputString('<script>alert(\'Password successfully changed\');</script>');
    }

    public function test_password_reset_failure_message()
    {
        // Simulate submitting the form with invalid credentials
        $_POST['newpassword'] = 'newPassword1';
        $_POST['confirmpassword'] = 'newPassword2';

        // Execute the code
        include(__DIR__ . '/../../users/reset-password.php');

        // Check if the password reset failure message is displayed
        $this->expectOutputString('<script>alert(\'New Password and Confirm Password field does not match\');</script>');
    }

    public function test_password_reset_invalid_credentials()
    {
        // Simulate submitting the form with empty credentials
        $_POST['newpassword'] = '';
        $_POST['confirmpassword'] = '';

        // Execute the code
        include(__DIR__ . '/../../users/reset-password.php');

        // Check if the password reset invalid credentials message is displayed
        $this->expectOutputString('<script>alert(\'New Password and Confirm Password field does not match\');</script>');
    }
}
