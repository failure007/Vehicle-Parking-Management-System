function testFloorLevelIncrement() {
  // Arrange
  $currentLevel = 1;

  // Act
  $newLevel = getParkingLevel($currentLevel);

  // Assert
  assertEquals(2, $newLevel);
}
