<?php
use PHPUnit\Framework\TestCase;

class DashboardTest extends TestCase {

    public function testCategoryAddition() {
        // Assuming the form data to add a category
        $formData = array(
            'catename' => 'Test Category',
            'vehicle_cost' => 10, // Example value for vehicle cost.
            
        );

        // Simulate a POST request to add-category.php
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = $formData;

        // Include the file for testing
        include 'add-category.php';

        // Performing assertions to verify the expected behavior
        
        $this->expectOutputRegex('/Category added successfully/'); 

        //performing database assertions here to confirm data insertion
        

        // Reset superglobals after the test
        $_SERVER['REQUEST_METHOD'] = '';
        $_POST = array();
    }
}
