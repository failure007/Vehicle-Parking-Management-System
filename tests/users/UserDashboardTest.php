<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UserDashboardTest extends TestCase
{
    public function test_welcome_message_contains_user_name()
    {
        $output = ob_get_clean();
        $this->assertStringContainsString('Welcome to panel !! User Name', $output);
    }

    public function test_traffic_chart_data_is_correct()
    {
        $output = ob_get_clean();
        $this->assertStringContainsString('[0, 18000, 35000, 25000, 22000, 0]', $output);
        $this->assertStringContainsString('[0, 33000, 15000, 20000, 15000, 300]', $output);
        $this->assertStringContainsString('[0, 15000, 28000, 15000, 30000, 5000]', $output);
    }

    public function test_bar_chart_data_is_correct()
    {
        $output = ob_get_clean();
        $this->assertStringContainsString('[[0, 18], [2, 8], [4, 5], [6, 13]', $output);
        $this->assertStringContainsString('[8,5], [10,7],[12,4], [14,6]', $output);
        $this->assertStringContainsString('[16,15], [18, 9],[20,17], [22,7]', $output);
        $this->assertStringContainsString('[24,4], [26,9],[28,11]]', $output);
    }
}
