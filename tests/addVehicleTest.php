<?php

use PHPUnit\Framework\TestCase;

class AddVehicleTest extends TestCase
{
    public function testAddVehicle()
    {
        include('add-vehicle.php');

        $_POST['submit'] = 'true';
        $_POST['catename'] = 'Test Category';
        $_POST['vehcomp'] = 'Test Company';
        $_POST['vehreno'] = 'Test123';
        $_POST['ownername'] = 'Test Owner';
        $_POST['ownercontno'] = '1234567890';

        ob_start();
        include('add-vehicle.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('Vehicle Entry Detail has been added', $output);
    }
}
