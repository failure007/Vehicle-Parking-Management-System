<?php

class BetweenDatesReportsDetailsTest extends PHPUnit\Framework\TestCase
{
    public function testGetBetweenDatesReportsDetails()
    {
        // Arrange
        $parkingNumber = '782367832';
        $ownerName = 'Sasikiran';
        $ownerContactNumber = '8372567823';
        $registrationNumber = '73867826802';
        $vehicleCompanyname = 'Toyota';
        $slotNumber = '1';
        $checkInTime = '2023-10-10';

        // Act
        $betweenDatesReportsDetails = getBetweenDatesReportsDetails($parkingNumber, $ownerName, $ownerContactNumber, $registrationNumber, $vehicleCompanyname, $slotNumber, $checkInTime);

        // Assert
        $this->assertGreaterThan(0, count($betweenDatesReportsDetails));
    }
}

function getBetweenDatesReportsDetails($parkingNumber, $ownerName, $ownerContactNumber, $registrationNumber, $vehicleCompanyname, $slotNumber, $checkInTime)
{
    // Simulate database query
    $betweenDatesReportsDetails = [
        [
            'parkingNumber' => $parkingNumber,
            'ownerName' => $ownerName,
            'ownerContactNumber' => $ownerContactNumber,
            'registrationNumber' => $registrationNumber,
            'vehicleCompanyname' => $vehicleCompanyname,
            'slotNumber' => $slotNumber,
            'checkInTime' => $checkInTime,
        ],
    ];
    return $betweenDatesReportsDetails;
}
