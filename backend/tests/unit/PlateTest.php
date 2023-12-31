<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\Plate;
use backend\models\Supplier;

class PlateTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    // a. Despoletar todas as regras de validação (introduzindo dados erróneos);
    public function testTriggerValidationErrors()
    {
        $this->tester->wantTo('Trigger validation errors');

        $plate = new Plate();
        $plate->description = ''; // Empty description should trigger validation error
        $plate->price = -1; // Invalid price should trigger validation error
        $plate->title = ''; // Empty title should trigger validation error
        $plate->supplier_id = null; // Null supplier ID should trigger validation error

        $saved = $plate->save();

        $this->assertFalse($saved, 'Validation should fail');
        $this->assertNotEmpty($plate->getErrors(), 'There should be validation errors');
    }

    public function testPlateLifecycle()
    {
        $this->tester->wantTo('Test the lifecycle of the Plate model');

        // b. Criar um registo válido e guardar na BD
        $plate = new Plate();
        $plate->description = 'A delicious dish'; // Set valid description
        $plate->price = 10.99; // Set valid price
        $plate->title = 'Yummy Plate'; // Set valid title
        $plate->date_time = date('Y-m-d H:i:s'); // Set valid date time
        $plate->supplier_id = 1; // Set valid supplier ID
        $this->assertTrue($plate->save(), 'Record should be saved successfully');
        $this->assertNotNull($plate->id, 'Record should have an ID after saving');

        // c. Ver se o registo válido se encontra na BD
        $foundPlate = Plate::findOne(['description' => 'A delicious dish']);
        $this->assertInstanceOf(Plate::class, $foundPlate, 'Plate should exist in the database');

        // d. Ler o registo anterior e aplicar um update
        $foundPlate->description = 'An even more delicious dish';
        $foundPlate->save();
        $updatedPlate = Plate::findOne(['description' => 'An even more delicious dish']);
        $this->assertInstanceOf(Plate::class, $updatedPlate, 'Plate should be updated in the database');
        $this->assertEquals($foundPlate->id, $updatedPlate->id, 'Plate IDs should match');

        // e. Ver se o registo atualizado se encontra na BD
        $verifiedUpdatedPlate = Plate::findOne(['description' => 'An even more delicious dish']);
        $this->assertInstanceOf(Plate::class, $verifiedUpdatedPlate, 'Plate should exist in the database');

        // f. Apagar o registo
        $verifiedUpdatedPlate->delete();

        // g. Verificar que o registo não se encontra na BD.
        $deletedPlate = Plate::findOne(['description' => 'An even more delicious dish']);
        $this->assertNull($deletedPlate, 'Plate should not exist in the database after deletion');
    }
}
