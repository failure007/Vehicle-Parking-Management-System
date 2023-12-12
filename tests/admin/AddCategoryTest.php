<?php

class AddCategoryTest extends PHPUnit\Framework\TestCase
{
    public function testAddCategory()
    {
        // Arrange
        $catename = 'New Category';
        $vehicle_cost = 100;

        // Act
        $result = addCategory($catename, $vehicle_cost);

        // Assert
        $this->assertTrue($result);
    }
}

function addCategory($catename, $vehicle_cost)
{
    // Simulate database insertion
    return true;
}
