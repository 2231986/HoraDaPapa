<?php


namespace backend\tests\Unit;

use app\models\Meal;
use backend\tests\UnitTester;

class MealTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testTriggerValidationErrors(){

        // a. Despoletar todas as regras de validação (introduzindo dados erróneos);

        $this->tester->wantTo('Trigger validation errors');

        $meal = new \app\models\Meal();
        $meal->dinner_table_id = null; // Dado Invalido, dinner_table_id é obrigatorio
        $meal->checkout = 'invalid_checkout'; // Dado invalido está a espera de um inteiro
        $meal->date_time = ''; // formato errado
    }

    public function testMealLifecycle()
    {
        $this->tester->wantTo('perform Meal model lifecycle testing');


        // b. Criar um registo válido e guardar na BD
        $meal = new \app\models\Meal();
        $meal->dinner_table_id = 1; // Definir preço válido
        $meal->checkout = 0;
        $meal->date_time = date('Y-m-d H:i:s');

        $this->assertTrue($meal->save(), 'Record should be saved successfully');
        $this->assertNotNull($meal->id, 'Record should have an ID after saving');

        // c. Ver se o registo válido se encontra na BD
        $foundMeal = \app\models\Meal::findOne($meal->id);
        $this->assertNotNull($foundMeal, 'Valid record should exist in the database');

        // d. Ler o registo anterior e aplicar um update
        $foundMeal->checkout = 1;
        $foundMeal->save();

        // e. Ver se o registo atualizado se encontra na BD
        $updatedMeal = \app\models\Meal::findOne($meal->id);
        $this->assertInstanceOf(Meal::class, $updatedMeal, 'Updated record should exist in the databasee');
        $this->assertEquals(1, $updatedMeal->checkout, 'Checkout status should be updated');

        // f. Apagar o registo
        $updatedMeal->delete();

        // g. Verificar que o registo não se encontra na BD.
        $deletedMeal = \app\models\Meal::findOne($meal->id);
        $this->assertNull($deletedMeal, 'Record should not exist in the database after deletion');
    }
}
