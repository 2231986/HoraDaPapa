<?php

namespace backend\tests\unit;

use app\models\Dinner;
use Yii;

class DinnerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testDinnerValidation()
    {
        $dinner = new Dinner();

        // Test with valid data
        $dinner->setAttributes([
            'name' => 'Table 1',
            'isClean' => 1,
        ]);

        $this->assertTrue($dinner->validate(), 'Validation passed with valid data');

        // Test with missing required data
        $dinner->setAttributes([
            'name' => null,
            'isClean' => null,
        ]);

        $this->assertFalse($dinner->validate(), 'Validation failed with missing required data');
    }

    public function testDinnerAttributes()
    {
        $dinner = new Dinner();

        // Test attribute assignments
        $dinner->name = 'Table 2';
        $dinner->isClean = 0;

        $this->assertEquals('Table 2', $dinner->name, 'Name attribute assigned correctly');
        $this->assertEquals(0, $dinner->isClean, 'IsClean attribute assigned correctly');
    }

    public function testDinnerCRUD()
    {
        // Create a new dinner
        $dinner = new Dinner();
        $dinner->setAttributes([
            'name' => 'Table 3',
            'isClean' => 1,
        ]);

        $this->assertTrue($dinner->save(), 'Dinner saved successfully');

        // Read the dinner from the database
        $savedDinner = Dinner::findOne($dinner->id);

        $this->assertNotNull($savedDinner, 'Dinner found in the database');
        $this->assertEquals('Table 3', $savedDinner->name, 'Name is correct');
        $this->assertEquals(1, $savedDinner->isClean, 'IsClean is correct');

        // Update the dinner
        $savedDinner->name = 'Updated Table';
        $savedDinner->save();

        // Read the updated dinner from the database
        $updatedDinner = Dinner::findOne($savedDinner->id);

        $this->assertEquals('Updated Table', $updatedDinner->name, 'Dinner name updated successfully');

        // Delete the dinner
        $updatedDinner->delete();

        // Try to find the deleted dinner
        $deletedDinner = Dinner::findOne($updatedDinner->id);

        $this->assertNull($deletedDinner, 'Dinner deleted successfully');
    }
}
