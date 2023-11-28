<?php

class UserSlotsAvailableTest extends PHPUnit\Framework\TestCase
{
    public function testDisplayParkingSlotOptions()
    {
        // Arrange
        $expectedOutput = '<div class="col-md-1"><a href="userparking-slots.php?floor_level=1" class="btn btn-success">B1</a></div>';

        // Act
        $output = generateParkingSlotOptions();

        // Assert
        $this->assertEquals($expectedOutput, $output);
    }

    public function testGenerateParkingSlotsLinksWithMultipleLevels()
    {
        // Arrange
        $parkingLevels = [1, 2, 3];
        $expectedOutput = '';

        foreach ($parkingLevels as $parkingLevel) {
            $expectedOutput .= '<div class="col-md-1"><a href="userparking-slots.php?floor_level=' . $parkingLevel . '" class="btn btn-success">B' . $parkingLevel . '</a></div>';
        }

        // Act
        $output = generateParkingSlotsLinks($parkingLevels);

        // Assert
        $this->assertEquals($expectedOutput, $output);
    }
}

function generateParkingSlotOptions()
{
    // Simulate database interaction to retrieve parking levels
    $parkingLevels = [1];

    $output = '';

    foreach ($parkingLevels as $parkingLevel) {
        $output .= '<div class="col-md-1"><a href="userparking-slots.php?floor_level=' . $parkingLevel . '" class="btn btn-success">B' . $parkingLevel . '</a></div>';
    }

    return $output;
}

function generateParkingSlotsLinks($parkingLevels)
{
    $output = '';

    foreach ($parkingLevels as $parkingLevel) {
        $output .= '<div class="col-md-1"><a href="userparking-slots.php?floor_level=' . $parkingLevel . '" class="btn btn-success">B' . $parkingLevel . '</a></div>';
    }

    return $output;
}
