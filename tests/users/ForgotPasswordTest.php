<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ForgotPasswordTest extends TestCase
{
    public function test_empty_form_submission()
    {
        // Simulate submitting the form with empty fields
        $_POST['email'] = '';
        $_POST['contactno'] = '';

        // Execute the code
        include(__DIR__ . '/../../users/forgot-password.php');

        // Capture output for assertion
        ob_start();

        // Check for invalid details alert
        $this->expectOutputString('<script>alert(\'Invalid Details. Please try again.\');</script>');

        // Clean up output buffer
        ob_end_clean();
    }

    public function test_invalid_email_format()
    {
        // Simulate submitting the form with an invalid email format
        $_POST['email'] = 'invalid_email';
        $_POST['contactno'] = '1234567890';

        // Execute the code
        include('forgot-password.php');

        // Capture output for assertion
        ob_start();

        // Check for invalid details alert
        $this->expectOutputString('<script>alert(\'Invalid Details. Please try again.\');</script>');

        // Clean up output buffer
        ob_end_clean();
    }

    public function test_valid_email_and_contactno()
    {
        // Simulate submitting the form with valid email and contactno
        $_POST['email'] = 'valid@email.com';
        $_POST['contactno'] = '1234567890';

        // Execute the code
        include('forgot-password.php');

        // Check for redirection to reset-password.php
        $this->expectOutputString('Location: reset-password.php');
    }
}
