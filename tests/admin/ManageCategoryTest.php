<?php

require 'includes/dbconnection.php';

class ManageCategoryTest extends PHPUnit_Framework_TestCase
{
    public function testManageCategory()
    {
        // Start a new session
        session_start();
        $_SESSION['vpmsaid'] = 1;

        // Mock the database connection
        $mockDbConnection = $this->createMock('mysqli');

        // Set up the $_GET data for viewing categories
        $_GET['del'] = '';

        // Process the page
        ob_start();
        include('manage-category.php');
        ob_end_clean();

        // Check that the user was not redirected
        $this->assertNotRedirect();

        // Check that the categories were displayed
        $this->assertContains('Manage Category', $output);

        // Set up the $_GET data for deleting a category
        $_GET['del'] = 1;

        // Mock the query to check if the category is booked
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->with('SELECT * FROM tbbookedslots WHERE vehicle_cat = \'1\' and veh_status=\'in\'')
            ->willReturn(mysqli_fetch_assoc(array()));

        // Mock the query to delete the category
        $mockDbConnection->expects($this->once())
            ->method('query')
            ->with('delete from tblcategory where ID = \'1\'')
            ->willReturn(true);

        // Process the page
        ob_start();
        include('manage-category.php');
        ob_end_clean();

        // Check that a success message was displayed
        $this->assertContains('Data Deleted', $output);

        // Check that the user was redirected
        $this->assertRedirect('manage-category.php');
    }
}
