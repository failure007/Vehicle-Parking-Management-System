<?php

class AccessControlTest extends PHPUnit\Framework\TestCase
{
    public function testLoginPageRedirectionForNonLoggedInUsers()
    {
       
        $_SESSION['vpmsuid'] = '';

        
        ob_start();
        try {
            include('users/add-vehicle.php');
            session_start(); // Start the session after successful inclusion
        } catch (Exception $e) {
            // Handle inclusion errors here if needed
        } finally {
            session_write_close(); // Close the session
        }
        $output = ob_get_clean();

        
        $this->assertContains('location:logout.php', $output);
    }
}
