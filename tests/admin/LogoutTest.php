<?php

class LogoutTest extends PHPUnit_Framework_TestCase
{
    public function testLogout()
    {
        // Start a new session
        session_start();
        $_SESSION['vpmsaid'] = 1;

        // Process the logout script
        include('logout.php');

        // Check that the session was destroyed
        $this->assertSessionDestroyed();

        // Check that the user was redirected to the index.php page
        $this->assertRedirect('index.php');
    }
}
