<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function test_empty_form_submission()
    {
        // Simulate submitting the form with empty fields
        $_POST['emailcont'] = '';
        $_POST['password'] = '';

        // Execute the code
        include(__DIR__ . '/../../users/login.php');

        // Capture output for assertion
        ob_start();

        // Check for alert message
        $this->expectOutputString('<script>alert(\'Invalid Details.\');</script>');

        // Clean up output buffer
        ob_end_clean();
    }

    public function test_invalid_email_format()
    {
        // Simulate submitting the form with an invalid email format
        $_POST['emailcont'] = 'invalid_email';
        $_POST['password'] = 'validpassword';

        // Execute the code
        include(__DIR__ . '/../../users/login.php');

        // Capture output for assertion
        ob_start();

        // Check for alert message
        $this->expectOutputString('<script>alert(\'Invalid Details.\');</script>');

        // Clean up output buffer
        ob_end_clean();
    }

    public function test_valid_credentials()
    {
        // Simulate submitting the form with valid credentials
        $_POST['emailcont'] = 'valid@email.com';
        $_POST['password'] = 'validpassword';

        // Execute the code
        include('login.php');

        // Check for redirection to dashboard.php
        $this->expectOutputString('Location: dashboard.php');
    }
}
