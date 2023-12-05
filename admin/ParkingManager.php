// admin/ParkingManager.php

namespace Admin;

class ParkingManager
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function addParkingLevel($noOfBlocks)
    {
        $getFloorLevelQuery = mysqli_query($this->con, "SELECT floor_level FROM tbparkingslots ORDER BY id DESC LIMIT 1");
        $floorLevel = mysqli_fetch_assoc($getFloorLevelQuery);
        $getLevel = $floorLevel['floor_level'] + 1;

        $query = mysqli_query($this->con, "INSERT INTO tbparkingslots(floor_level, no_of_blocks) VALUES ('$getLevel','$noOfBlocks')");

        return $query;
    }
}
