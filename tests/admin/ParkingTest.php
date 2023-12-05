use PHPUnit\Framework\TestCase;
use Admin\ParkingManager;

class ParkingTest extends TestCase
{
    public function testAddParkingLevel()
    {
        // Mock your database connection if needed
        $con = $this->createMock(mysqli::class);

        $parkingManager = new ParkingManager($con);

        $result = $parkingManager->addParkingLevel(5);

        // Perform assertions based on your test case
        $this->assertTrue($result);
    }
}
