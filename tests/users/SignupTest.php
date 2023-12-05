<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase {
    public function test_successful_registration() {
        // Simulate submitting the form with valid credentials
        $_POST['firstname'] = 'sasi';
        $_POST['lastname'] = 'kiran';
        $_POST['mobilenumber'] = '1234567890';
        $_POST['email'] = 'sasi@example.com';
        $_POST['password'] = 'password';
        $_POST['repeatpassword'] = 'password';

        // Execute the code
        include(__DIR__ . '/../../users/signup.php');

        // Check if the registration success message is displayed
        $this->expectOutputString('<script>alert("You have successfully registered")</script>');

        // Check if the user is redirected to the login page after registration
        $this->assertHeaderRedirect('Location: login.php');
    }

    public function test_duplicate_email_registration_failure() {
        // Simulate submitting the form with an existing email address
        $_POST['firstname'] = 'sasi';
        $_POST['lastname'] = 'kiran';
        $_POST['mobilenumber'] = '9876543210';
        $_POST['email'] = 'sasi@example.com'; // Existing email address
        $_POST['password'] = 'password';
        $_POST['repeatpassword'] = 'password';

        // Execute the code
        include(__DIR__ . '/../../users/signup.php');

        // Check if the duplicate email registration failure message is displayed
        $this->expectOutputString('<script>alert("This email or Contact Number already associated with another account")</script>');

        // Check if the user is not redirected to the login page after registration failure
        $this->assertHeaderNotContains('Location: login.php');
    }

    public function test_invalid_password_registration_failure() {
        // Simulate submitting the form with mismatched passwords
        $_POST['firstname'] = 'dheeraj';
        $_POST['lastname'] = 'kumar';
        $_POST['mobilenumber'] = '9876543210';
        $_POST['email'] = 'dkumar@example.com';
        $_POST['password'] = 'password1';
        $_POST['repeatpassword'] = 'password2';

        // Execute the code
        include(__DIR__ . '/../../users/signup.php');

        // Check if the invalid password registration failure message is displayed
        $this->expectOutputString('<script>alert("Password and Repeat Password field does not match")</script>');

        // Check if the user is not redirected to the login page after registration failure
        $this->assertHeaderNotContains('Location: login.php');
    }

    public function test_empty_fields_registration_failure() {
        // Simulate submitting the form with empty fields
        $_POST['firstname'] = '';
        $_POST['lastname'] = '';
        $_POST['mobilenumber'] = '';
        $_POST['email'] = '';
        $_POST['password'] = '';
        $_POST['repeatpassword'] = '';

        // Execute the code
        include(__DIR__ . '/../../users/signup.php');

        // Check if the empty fields registration failure message is displayed
        $this->expectOutputString('<script>alert("Please fill in all the required fields")</script>');

        // Check if the user is not redirected to the login page after registration failure
        $this->assertHeaderNotContains('Location: login.php');
    }
}
