<?php

use PHPUnit\Framework\TestCase;

class EditCategoryTest extends TestCase
{
    public function testEditCategory()
    {
        include('edit-category.php');

        $_POST['submit'] = 'true';
        $_POST['catename'] = 'Updated Category';
        $_POST['vehicle_cost'] = '75';

        $_GET['editid'] = '1'; 

        ob_start();
        include('edit-category.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('Category Details updated', $output);
    }
}
