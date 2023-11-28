<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class logoutTest extends TestCase
{
    public function test_session_destroyed_and_redirected_to_login_page()
    {
        // Execute the code
        include('logout.php');

        // Check for session status
        $this->assertEquals(session_status(), PHP_SESSION_NONE);

        // Check for redirection to login.php
        $this->expectOutputString('Location: login.php');
    }
}
