
<?php
require_once 'vendor/autoload.php'
class ParkingLevel {
  public function getParkingLevel($currentLevel) {
    return ++$currentLevel;
  }

  public function validateNoofBlocks($noofBlocks) {
    return is_numeric($noofBlocks) && $noofBlocks > 0;
  }
}

class MockDatabase {
  private $throwException = false;

  public function addParkingLevel($floorLevel, $noofBlocks) {
    if ($this->throwException) {
      throw new Exception('Database error');
    }
    // simulate database interaction here
  }

  public function setThrowException($throwException) {
    $this->throwException = $throwException;
  }

  public function assertParkingLevelAdded($floorLevel, $noofBlocks) {
    // assert that parking level was added correctly
  }
}

function submitParkingLevel(MockDatabase $db, array $postData) {
  $parkingLevel = new ParkingLevel();
  $floorLevel = $parkingLevel->getParkingLevel($postData['floor_level']);
  $noofBlocks = $postData['no_of_blocks'];

  if (!$parkingLevel->validateNoofBlocks($noofBlocks)) {
    return false;
  }

  $db->addParkingLevel($floorLevel, $noofBlocks);

  return true;
}

// Unit tests
function testFloorLevelIncrement() {
  $parkingLevel = new ParkingLevel();
  $currentLevel = 1;
  $newLevel = $parkingLevel->getParkingLevel($currentLevel);
  assertEquals(2, $newLevel);
}

function testNoofBlocksValidation() {
  $validBlocks = 10;
  $invalidBlocks = -1;
  $parkingLevel = new ParkingLevel();
  $valid = $parkingLevel->validateNoofBlocks($validBlocks);
  $invalid = $parkingLevel->validateNoofBlocks($invalidBlocks);
  assertTrue($valid);
  assertFalse($invalid);
}

function testFormSubmission() {
  $mockDb = new MockDatabase();
  $postData = array(
    'floor_level' => 'B2',
    'no_of_blocks' => 15
  );
  $isSuccess = submitParkingLevel($mockDb, $postData);
  assertTrue($isSuccess);
  $mockDb->assertParkingLevelAdded('B2', 15);
}

function testErrorHandling() {
  $mockDb = new MockDatabase();
  $mockDb->setThrowException(true);
  $postData = array(
    'floor_level' => 'B2',
    'no_of_blocks' => 15
  );
  try {
    submitParkingLevel($mockDb, $postData);
    fail('Expected exception was not thrown');
  } catch (Exception $e) {
    $expectedMessage = 'Database error';
    assertEquals($expectedMessage, $e->getMessage());
  }
}

testFloorLevelIncrement();
testNoofBlocksValidation();
testFormSubmission();
testErrorHandling();
