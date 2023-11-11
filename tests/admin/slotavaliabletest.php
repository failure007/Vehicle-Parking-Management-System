<?php

namespace Tests\Admin;

use PHPUnit\Framework\TestCase;

class SlotsAvailableTest extends TestCase
{
    /**
     * @dataProvider floorLevelDataProvider
     */
    public function testFloorLevelIterator($floorLevels)
    {
        // Mock the database connection
        $mockedConnection = $this->createMock(\mysqli::class);
        $mockedResult = $this->createMock(\mysqli_result::class);
        $mockedResult->expects($this->once())
            ->method('fetch_array')
            ->willReturnOnConsecutiveCalls(...$floorLevels);
        $mockedConnection->expects($this->once())
            ->method('query')
            ->willReturn($mockedResult);

        // Mock the include function to capture output
        $this->startOutputBuffer();
        include 'path/to/slots-available.php';
        $output = $this->getActualOutput();
        $this->endOutputBuffer();

        foreach ($floorLevels as $floorLevel) {
            $this->assertStringContainsString('<a href="booking-slots-list.php?floor_level=' . $floorLevel['floor_level'] . '" class="btn btn-success">B' . $floorLevel['floor_level'] . '</a>', $output);
        }
    }

    /**
     * Data provider for floor levels
     */
    public function floorLevelDataProvider()
    {
        return [
            [['floor_level' => '1']],
            [['floor_level' => '2']],

        ];
    }
}
