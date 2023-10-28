<?php

use PHPUnit\Framework\TestCase;

class PrintTest extends TestCase
{
    public function testPrintReceipt()
    {
        $_SESSION['vpmsaid'] = 1;
        $_GET['vid'] = '1'; 
        ob_start();
        include('print.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('Vehicle Parking receipt', $output);
        $this->assertStringContainsString('Parking Number', $output);
        $this->assertStringContainsString('Vehicle Category', $output);
    }
}
