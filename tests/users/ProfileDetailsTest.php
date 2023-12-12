<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ProfileDetailsTest extends TestCase
{
    public function test_user_details_displayed()
    {
        // Simulate accessing the page for a valid user ID
        $_SESSION['vpmsuid'] = 123;

        // Execute the code
        include('profile.php');

        // Check if the user details are displayed
        $this->expectOutputString('<td align="center">' . $_SESSION['vpmsuid'] . '</td>');
    }

    public function test_registration_date_displayed()
    {
        // Simulate accessing the page for a valid user ID with a registration date
        $_SESSION['vpmsuid'] = 123;
        $registrationDate = '2023-11-27';

        // Execute the code
        include('profile.php');

        // Check if the registration date is displayed
        $this->expectOutputString('<input type="text" name="regdate" value="' . $registrationDate . '" readonly="true" class="form-control">');
    }

    public function test_update_profile_success_message()
    {
        // Simulate accessing the page with valid user details and submitting the update form
        $_SESSION['vpmsuid'] = 123;
        $_POST['firstname'] = 'UpdatedFirstName';
        $_POST['lastname'] = 'UpdatedLastName';

        // Execute the code
        include('profile.php');

        // Check if the update profile success message is displayed
        $this->expectOutputString('<script>alert("Profile updated successully.")</script>');
    }

    public function test_update_profile_failure_message()
    {
        // Simulate accessing the page with invalid user details and submitting the update form
        $_SESSION['vpmsuid'] = 999;
        $_POST['firstname'] = 'UpdatedFirstName';
        $_POST['lastname'] = 'UpdatedLastName';

        // Execute the code
        include('profile.php');

        // Check if the update profile failure message is displayed
        $this->expectOutputString('<script>alert("Something Went Wrong. Please try again.")</script>');
    }
}
