<?php

require 'includes/dbconnection.php';

class LoginTest extends PHPUnit_Framework_TestCase
{
    public function testValidLogin()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(mysqli_query($con, "SELECT ID FROM tbladmin WHERE UserName='admin' AND Password='admin'"));

        // Set up the $_POST data
        $_POST['username'] = 'admin';
        $_POST['password'] = 'admin';

        // Process the form submission
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was redirected to the dashboard.php page
        $this->assertRedirect('dashboard.php');

        // Check that the session variable was set
        $this->assertNotEmpty($_SESSION['vpmsaid']);
    }

    public function testInvalidLogin()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(false);

        // Set up the $_POST data
        $_POST['username'] = 'invalid_user';
        $_POST['password'] = 'invalid_password';

        // Process the form submission
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was not redirected
        $this->assertNotRedirect();

        // Check that an alert message was displayed
        $this->assertContains('Invalid Details.', $output);
    }
}
