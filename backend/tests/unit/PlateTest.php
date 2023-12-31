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
        $plate->description = ''; // Descrição vazia, campo obrigatorio
        $plate->price = -1; // Dado invalido valor negativo, esta a espera de um float positivo
        $plate->title = ''; // Campo obrigatorio
        $plate->supplier_id = null; // Campo obrigatorio

        $saved = $plate->save();

        $this->assertFalse($saved, 'Validation should fail');
        $this->assertNotEmpty($plate->getErrors(), 'There should be validation errors');
    }

    public function testPlateLifecycle()
    {
        $this->tester->wantTo('Test the lifecycle of the Plate model');

        // b. Criar um registo válido e guardar na BD
        $plate = new Plate();
        $plate->description = 'A delicious dish'; // Definir descriçao válida
        $plate->price = 10.99; // Definir preço válido
        $plate->title = 'Yummy Plate'; // Definir titulo válido
        $plate->date_time = date('Y-m-d H:i:s'); // Definir data válida em determinado formato
        $plate->supplier_id = 1; // Definir supplier válido
        $this->assertTrue($plate->save(), 'Record should be saved successfully');
        $this->assertNotNull($plate->id, 'Record should have an ID after saving');

        // c. Ver se o registo válido se encontra na BD
        $foundPlate = Plate::findOne(['description' => 'A delicious dish']);
        $this->assertInstanceOf(Plate::class, $foundPlate, 'Plate should exist in the database');

        // d. Ler o registo anterior e aplicar um update
        $foundPlate->description = 'An even more delicious dish';
        $foundPlate->save();

        // e. Ver se o registo atualizado se encontra na BD
        $verifiedUpdatedPlate = Plate::findOne(['description' => 'An even more delicious dish']);
        $this->assertInstanceOf(Plate::class, $verifiedUpdatedPlate, 'Plate should exist in the database');
        $this->assertEquals($foundPlate->id, $verifiedUpdatedPlate->id, 'Plate IDs should match');


        // f. Apagar o registo
        $verifiedUpdatedPlate->delete();

        // g. Verificar que o registo não se encontra na BD.
        $deletedPlate = Plate::findOne(['description' => 'An even more delicious dish']);
        $this->assertNull($deletedPlate, 'Plate should not exist in the database after deletion');
    }
}
