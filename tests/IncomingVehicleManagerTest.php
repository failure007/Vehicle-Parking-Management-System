<?php
// tests/IncomingVehicleManagerTest.php

use PHPUnit\Framework\TestCase;

class IncomingVehicleManagerTest extends TestCase
{
    // Mock database connection
    private $con;

    public function setUp(): void
    {
        $this->con = $this->getMockBuilder('DBConnectionClass')->getMock();
    }

    public function testRedirectIfNotLoggedIn()
    {
        // Mock session
        $_SESSION['vpmsaid'] = '';

        $manager = new IncomingVehicleManager($this->con);
        $manager->redirectIfNotLoggedIn();

        // Check if header function was called
        $this->assertStringContainsString('location:logout.php', xdebug_get_headers());
    }

    public function testDeleteBookedSlot()
    {
        $catid = 1;

        // Mock database query
        $this->con->expects($this->once())
            ->method('query')
            ->with("delete from tbbookedslots where id ='$catid'")
            ->willReturn(true);

        $manager = new IncomingVehicleManager($this->con);
        $result = $manager->deleteBookedSlot($catid);

        $this->assertTrue($result);
    }

    // Add more test cases for other methods as needed
}
