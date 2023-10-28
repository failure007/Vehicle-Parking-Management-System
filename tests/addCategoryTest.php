<?php

use PHPUnit\Framework\TestCase;

class AddCategoryTest extends TestCase
{
    public function testAddCategory()
    {
        include('add-category.php');

        $_POST['submit'] = 'true';
        $_POST['catename'] = 'Test Category';
        $_POST['vehicle_cost'] = '50';


        ob_start();
        include('add-category.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('Category added successfully', $output);
    }
}
