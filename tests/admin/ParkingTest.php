<?php

use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase
{
    public function testAddParkingLevel()
    {
        // Include your original file
        include 'add-baselevel.php';

        // Set up a fake session
        $_SESSION['vpmsaid'] = 'fakeUserId';

        // Mock the database connection
        $con = $this->createMock(mysqli::class);

        // Set up the expected values for the query
        $expectedFloorLevel = 42;
        $expectedNoOfBlocks = 5;

        // Mock the POST data
        $_POST['no_of_blocks'] = $expectedNoOfBlocks;

        // Mock the query result
        $con->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Mock the fetch_assoc result
        $con->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(['floor_level' => $expectedFloorLevel]);

        // Replace the global $con variable with the mocked connection
        global $con;
        $con = $con;

        // Call the function to be tested
        ob_start(); // Catch the echo output
        include 'your_original_file.php';
        $output = ob_get_clean();

        // Perform assertions based on your expected output
        $this->assertStringContainsString('Parking Level added successfully', $output);
        // Add more assertions as needed

        // Clean up any changes made during the test
        unset($_SESSION['vpmsaid']);
        unset($_POST['no_of_blocks']);
        unset($GLOBALS['con']);
    }
}
