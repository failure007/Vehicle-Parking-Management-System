#add-baselvltest.php
<?php

namespace Tests\Admin;

use PHPUnit\Framework\TestCase;

class AddBaseLevelTest extends TestCase
{
    /**
     * @dataProvider parkingLevelDataProvider
     */
    public function testAddParkingLevelForm($floorLevel)
    {
        // Mock the database connection
        $mockedConnection = $this->createMock(\mysqli::class);
        $mockedConnection->expects($this->once())
            ->method('query')
            ->willReturn($this->createMock(\mysqli_result::class));

        // Mock the include function to capture output
        $this->startOutputBuffer();
        include 'path/to/addbaselevel.php';
        $output = $this->getActualOutput();
        $this->endOutputBuffer();

	$this->assertStringContainsString('<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">', $output);
        $this->assertStringContainsString('<button type="submit" class="btn btn-primary btn-sm" name="submit">Add</button>', $output);
    }

    /**
     * Data provider for floor levels
     */
    public function parkingLevelDataProvider()
    {
	return [
            ['1'],
            ['2']
	];
    }
}
