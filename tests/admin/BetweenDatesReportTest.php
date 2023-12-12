<?php

class BetweenDatesReportTest extends PHPUnit\Framework\TestCase
{
    public function testGetBetweenDatesReport()
    {
        // Arrange
        $fromDate = '2023-10-01';
        $toDate = '2023-10-31';

        // Act
        $betweenDatesReport = getBetweenDatesReport($fromDate, $toDate);

        // Assert
        $this->assertGreaterThan(0, count($betweenDatesReport));
    }
}

function getBetweenDatesReport($fromDate, $toDate)
{
    // Simulate database query
    $betweenDatesReport = [
        [
            'parkingNumber' => '72362803982',
            'ownerName' => 'Sasikiran',
            'ownerContactNumber' => '378267023278',
            'registrationNumber' => '785237296726',
            'vehicleCompanyname' => 'Toyota',
            'slotNumber' => '1',
            'checkInTime' => '2023-10-10',
        ],
        [
            'parkingNumber' => '7235792592',
            'ownerName' => 'Sasikiran',
            'ownerContactNumber' => '72537892369',
            'registrationNumber' => '7263798236',
            'vehicleCompanyname' => 'Honda',
            'slotNumber' => '2',
            'checkInTime' => '2023-10-15',
        ],
    ];
    return $betweenDatesReport;
}
