<?php

use PHPUnit\Framework\TestCase;

class OutgoingVehicleManagerTest extends TestCase
{
    private $manager;
    private $con;

    public function setUp(): void
    {
        $this->con = $this->getMockBuilder('DBConnectionClass')->getMock();
        $this->manager = new OutgoingVehicleManager($this->con);
    }

    public function testRedirectIfNotLoggedIn()
    {
        $_SESSION['vpmsaid'] = '';

        // Mock header function
        $this->expectOutputString('');
        $this->manager->redirectIfNotLoggedIn();
        $this->assertStringContainsString('location:logout.php', xdebug_get_headers());
    }

    public function testDeleteVehicle()
    {
        $catid = 1;

        // Mock database query
        $this->con->expects($this->once())
            ->method('query')
            ->with("delete from tblvehicle where ID ='$catid'")
            ->willReturn(true);

        // Mock echo statements
        $this->expectOutputString("<script>alert('Data Deleted');</script><script>window.location.href='manage-outgoingvehicle.php'</script>");

        $result = $this->manager->deleteVehicle($catid);

        $this->assertTrue($result);
    }

    public function testFetchOutgoingVehicles()
    {
        // Mock database query
        $this->con->expects($this->once())
            ->method('query')
            ->with("SELECT b.*, v.*
                FROM tbbookedslots AS b
                INNER JOIN tblvehicle AS v ON b.vehicle_id = v.ID
                WHERE veh_status = 'out'")
            ->willReturn($this->createMock('MySQLi_Result'));

        $result = $this->manager->fetchOutgoingVehicles();

        $this->assertInstanceOf('MySQLi_Result', $result);
    }
}
