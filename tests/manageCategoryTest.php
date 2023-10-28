<?php

use PHPUnit\Framework\TestCase;

class ManageCategoryTest extends TestCase
{
    public function testDeleteCategory()
    {
        include('manage-category.php');

        $_GET['del'] = '1';

        ob_start();
        include('manage-category.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('Data Deleted', $output);
    }
}
