<?php

class AdminProfileTest extends PHPUnit\Framework\TestCase
{
    public function testAdminProfileUpdateSuccess()
    {
        // Arrange
        $adminId = 1;
        $adminName = 'Dheeraj';
        $contactNumber = '9876543210';
        $dbConnectionMock = $this->createMock(mysqli::class);

        $dbConnectionMock->expects($this->once())
            ->method('query')
            ->with('update tbladmin set AdminName=\'' . $adminName . '\', MobileNumber=\'' . $contactNumber . '\' where ID=\'' . $adminId . '\'')
            ->willReturn(true);

        // Act
        $adminProfileUpdate = new AdminProfileUpdate($dbConnectionMock);
        $result = $adminProfileUpdate->updateAdminProfile($adminId, $adminName, $contactNumber);

        // Assert
        $this->assertTrue($result);
    }

    public function testAdminProfileUpdateFailure()
    {
        // Arrange
        $adminId = 1;
        $adminName = 'Dheeraj';
        $contactNumber = '9876543210';
        $dbConnectionMock = $this->createMock(mysqli::class);

        $dbConnectionMock->expects($this->once())
            ->method('query')
            ->with('update tbladmin set AdminName=\'' . $adminName . '\', MobileNumber=\'' . $contactNumber . '\' where ID=\'' . $adminId . '\'')
            ->willReturn(false);

        // Act
        $adminProfileUpdate = new AdminProfileUpdate($dbConnectionMock);
        $result = $adminProfileUpdate->updateAdminProfile($adminId, $adminName, $contactNumber);

        // Assert
        $this->assertFalse($result);
    }
}
