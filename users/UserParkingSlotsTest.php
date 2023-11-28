<?php

class UserParkingSlotsTest extends PHPUnit\Framework\TestCase
{
    public function testBookParkingSlot()
    {
        // Arrange
        $userName = 'testuser';
        $vehicleId = 1;
        $vehicleCatId = 1;
        $floorLevel = 1;
        $bookedSlot = 1;
        $bookingType = 'spot';
        $checkInTime = date('Y-m-d H:i:s');

        // Act
        $result = bookParkingSlot($userName, $vehicleId, $vehicleCatId, $floorLevel, $bookedSlot, $bookingType, $checkInTime);

        // Assert
        $this->assertTrue($result);
    }

    public function testBookParkingSlotWithInvalidVehicleId()
    {
        // Arrange
        $userName = 'testuser';
        $vehicleId = 1000; // Invalid vehicle ID
        $vehicleCatId = 1;
        $floorLevel = 1;
        $bookedSlot = 1;
        $bookingType = 'spot';
        $checkInTime = date('Y-m-d H:i:s');

        // Act
        $result = bookParkingSlot($userName, $vehicleId, $vehicleCatId, $floorLevel, $bookedSlot, $bookingType, $checkInTime);

        // Assert
        $this->assertFalse($result);
    }

    public function testBookParkingSlotWithInvalidBookingType()
    {
        // Arrange
        $userName = 'testuser';
        $vehicleId = 1;
        $vehicleCatId = 1;
        $floorLevel = 1;
        $bookedSlot = 1;
        $bookingType = 'invalid'; // Invalid booking type
        $checkInTime = date('Y-m-d H:i:s');

        // Act
        $result = bookParkingSlot($userName, $vehicleId, $vehicleCatId, $floorLevel, $bookedSlot, $bookingType, $checkInTime);

        // Assert
        $this->assertFalse($result);
    }

    public function testBookParkingSlotWithInvalidCheckInTimeForFutureBooking()
    {
        // Arrange
        $userName = 'testuser';
        $vehicleId = 1;
        $vehicleCatId = 1;
        $floorLevel = 1;
        $bookedSlot = 1;
        $bookingType = 'future';
        $checkInTime = date('Y-m-d H:i:s', strtotime('-1 day')); // Invalid check-in time for future booking

        // Act
        $result = bookParkingSlot($userName, $vehicleId, $vehicleCatId, $floorLevel, $bookedSlot, $bookingType, $checkInTime);

        // Assert
        $this->assertFalse($result);
    }
}

function bookParkingSlot($userName, $vehicleId, $vehicleCatId, $floorLevel, $bookedSlot, $bookingType, $checkInTime)
{
    // Simulate database interaction to check if parking slot can be booked

    if ($vehicleId > 0 && $bookingType === 'spot') {
        return true;
    } else {
        return false;
    }
}
