<?php

require 'includes/dbconnection.php';

class UserLoginTest extends PHPUnit_Framework_TestCase
{
    public function testValidUserLogin()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Mock the fetch_array function
        $mockFetchArray = $this->createMock('mysqli_result');
        $mockFetchArray->expects($this->once())
            ->method('fetch_array')
            ->willReturn(['ID' => 1]);

        // Set up the $_POST data
        $_POST['contactno'] = '376783296';
        $_POST['email'] = 'Chinnikrishnan@gmail.com;

        // Process the login form
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was redirected to the reset-password.php page
        $this->assertRedirect('reset-password.php');

        // Check that the $_SESSION variables were set correctly
        $this->assertEquals('7632572867283', $_SESSION['contactno']);
        $this->assertEquals('Chinnikrishnan@gmail.com', $_SESSION['email']);
    }

    public function testInvalidUserLogin()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Mock the fetch_array function
        $mockFetchArray = $this->createMock('mysqli_result');
        $mockFetchArray->expects($this->once())
            ->method('fetch_array')
            ->willReturn(false);

        // Set up the $_POST data
        $_POST['contactno'] = '27364723678';
        $_POST['email'] = 'Chinnikrishnan@gmail.com';

        // Process the login form
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was not redirected
        $this->assertNotRedirect();

        // Check that an alert message was displayed
        $this->assertContains('Invalid Details. Please try again.', $output);
    }
}
