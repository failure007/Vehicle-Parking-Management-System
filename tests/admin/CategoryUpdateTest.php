<?php

require 'includes/dbconnection.php';

class CategoryUpdateTest extends PHPUnit_Framework_TestCase
{
    public function testValidCategoryUpdate()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Set up the $_GET and $_POST data
        $_GET['editid'] = 1;
        $_POST['catename'] = 'Updated Category Name';
        $_POST['vehicle_cost'] = 200;

        // Process the form submission
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was redirected to the manage-category.php page
        $this->assertRedirect('manage-category.php');

        // Check that the category was updated in the database
        $query = mysqli_query($mockDbConnection, "SELECT VehicleCat, VehicleCost FROM tblcategory WHERE ID=1");
        $row = mysqli_fetch_array($query);
        $this->assertEquals('Updated Category Name', $row['VehicleCat']);
        $this->assertEquals(200, $row['VehicleCost']);
    }

    public function testInvalidCategoryUpdate()
    {
        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->willReturn(false);

        // Set up the $_GET and $_POST data
        $_GET['editid'] = 1;
        $_POST['catename'] = 'Invalid Category Name';
        $_POST['vehicle_cost'] = 100;

        // Process the form submission
        ob_start();
        include('index.php');
        ob_end_clean();

        // Check that the user was not redirected
        $this->assertNotRedirect();

        // Check that an alert message was displayed
        $this->assertContains('Something Went Wrong. Please try again', $output);
    }
}
