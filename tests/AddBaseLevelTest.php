<?php

use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase
{
    private $con; 
    public function setUp(): void
    {
 
        $this->con = new mysqli("your_test_db_host", "your_test_db_user", "your_test_db_password", "your_test_db_name");
       
    }

    public function tearDown(): void
    {
        $this->con->close();
    }

    public function testParkingLevelIterator()
    {
        $iterator = new ParkingLevelIterator($this->con);
        $this->assertInstanceOf(ParkingLevelIterator::class, $iterator);
    }

    public function testFormSubmission()
    {
        $_POST['no_of_blocks'] = 5;

        $parkingLevelIterator = new ParkingLevelIterator($this->con);
        $floorLevel = $parkingLevelIterator->current()['floor_level'] + 1;


        ob_start();
        include 'your_file_name.php'; 
        $output = ob_get_clean();

        $this->assertStringContainsString('Parking Level added successfully', $output);
    }
}
