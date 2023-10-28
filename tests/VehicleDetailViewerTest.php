<?php

use PHPUnit\Framework\TestCase;

class VehicleDetailViewerTest extends TestCase
{
    private $viewer;
    private $con;

    public function setUp(): void
    {
        $this->con = $this->getMockBuilder('DBConnectionClass')->getMock();
        $this->viewer = new VehicleDetailViewer($this->con);
    }

    public function testRedirectIfNotLoggedIn()
    {
        $_SESSION['vpmsaid'] = '';

        $this->expectOutputString('');
        $this->viewer->redirectIfNotLoggedIn();
        $this->assertStringContainsString('location:logout.php', xdebug_get_headers());
    }

    public function testFetchVehicleDetails()
    {
        $cid = 1;

        // Mock database query
        $this->con->expects($this->once())
            ->method('query')
            ->with("select * from tblvehicle where ID='$cid'")
            ->willReturn($this->createMock('MySQLi_Result'));

        $result = $this->viewer->fetchVehicleDetails($cid);

        $this->assertInstanceOf('MySQLi_Result', $result);
    }
}
