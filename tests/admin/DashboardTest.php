<?php

class DashboardTest extends PHPUnit\Framework\TestCase
{
    public function testDashboardDisplaysListedCategoriesWithoutMysqli()
    {
        // Mock the DashboardWithoutMysqli class
        $dashboard = $this->getMockBuilder('DashboardWithoutMysqli')
            ->setMethods(['getListedCategories'])
            ->getMock();

        // Set up the expected number of listed categories
        $expectedListedCategories = 3;

        // Mock the getListedCategories method to return the expected value
        $dashboard->expects($this->once())->method('getListedCategories')->willReturn($expectedListedCategories);

        // Capture the dashboard content rendered by displayDashboard
        $capturedDashboardContent = null;
        $dashboard->expects($this->once())->method('displayDashboard')
            ->willReturnCallback(function () use (&$capturedDashboardContent) {
                $capturedDashboardContent = ob_get_clean();
            });

        // Call the displayDashboard method
        $dashboard->displayDashboard();

        // Assert that the number of listed categories is displayed in the HTML output
        $this->assertStringContainsString('<span class="count"><a href="manage-category.php">3</a></span>', $capturedDashboardContent);
    }
}
