#printtest.php
<?php
namespace Tests\Admin;

use PHPUnit\Framework\TestCase;

class PrintTest extends TestCase
{
    /**
     * @dataProvider receiptData
     */
    public function testReceiptIterator($con, $cid, $expected)
    {
        $iterator = new \ReceiptIterator($con, $cid);
        foreach ($iterator as $data) {
            $this->assertEquals($expected, $data);
        }
    }

    public function receiptData()
    {
        // Provide data for testing ReceiptIterator
        return [
            // Add test cases as needed
            // Example: [$con, $cid, $expectedData],
        ];
    }
}
