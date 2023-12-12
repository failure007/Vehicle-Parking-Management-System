<?php

class ResetPasswordTest extends PHPUnit\Framework\TestCase
{
    public function testResetPassword()
    {
        // Arrange
        $contactno = '1234567890';
        $email = 'test@example.com';
        $oldPassword = '123456';
        $newPassword = 'newpassword';

        // Act
        $query = mysqli_query($con, "update tbladmin set Password='$newPassword' where Email='$email' && MobileNumber='$contactno'");
        $result = mysqli_affected_rows($con);

        // Assert
        $this->assertEquals(1, $result);
    }
}
