<?php

class UpdateCategoryTest extends PHPUnit\Framework\TestCase
{
    public function testUpdateCategory()
    {
        // Mock the database connection
        $dbConnection = $this->createMock('mysqli');

        // Mock the query method
        $queryMethod = $dbConnection->expects($this->once())
            ->method('query')
            ->with('update tblcategory set VehicleCat=\'Updated Category Name\', VehicleCost=\'99.99\' where ID=\'1\'');

        // Set up the request data
        $_POST['catename'] = 'Updated Category Name';
        $_POST['vehicle_cost'] = '99.99';
        $_GET['editid'] = '1';

        // Include the code under test
        include('update-category.php');

        // Verify that the query was called with the expected parameters
        $queryMethod->verify();
    }
}
