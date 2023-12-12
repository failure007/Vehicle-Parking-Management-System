<?php

class ManageRegUsersTest extends PHPUnit\Framework\TestCase
{
    public function testDeleteRegUsers()
    {
        // Arrange
        $id = 1;

        // Act
        $result = mysqli_query($con, "select * from tblregusers where ID='$id'");
        $row = mysqli_fetch_assoc($result);
        $user_contact = $row['MobileNumber'];
        $user_mail = $row['Email'];
        $userBookedData = mysqli_query($con, "SELECT * FROM tbbookedslots where user_name ='$user_contact' or user_name = '$user_mail'");
        $user_booked_data = mysqli_fetch_assoc($userBookedData);

        // Assert
        $this->assertEquals(true, $result);
        if (empty($user_booked_data)) {
            $this->assertEquals(1, mysqli_query($con, "delete from tblregusers where ID ='$id'"));
        } else {
            $this->expectOutputString('Parking Slots are Booked with this User.');
        }
    }
}
