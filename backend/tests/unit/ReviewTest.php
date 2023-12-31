<?php


namespace backend\tests\Unit;

use app\models\Review;
use backend\tests\UnitTester;

class ReviewTest extends \Codeception\Test\Unit
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

        $this->tester->wantTo('check validation');

        // Step a: Trigger all validation rules (introduce erroneous data)
        $review = new \app\models\Review();
        $review->user_id = null; // Dado invalido, campo obrigatorio
        $review->plate_id = null; // Dado invalido, campo obrigatorio
        $review->description = ''; // Dado invalido, campo obrigatorio
        $review->value = 'invalid_value'; // Dado invalido, campo obrigatorio e deve ser de tipo de dados inteiro
        $review->date_time = ''; // Dado invalido,nao respeita o formato de data

        $this->assertFalse($review->validate(), 'Should not validate with erroneous data');

    }

    // Tests
    public function testReviewLifecycle()
    {
        // b. Criar um registo válido e guardar na BD
        $review = new Review();
        $review->user_id = 66; // Definir user válido existente
        $review->plate_id = 1; // Definir prato válido existente
        $review->description = 'Valid description';// Definir descrição valida, string
        $review->value = 5; // Definir pontuaçao válida, tipo de dados integer


        $this->assertTrue($review->validate(), 'Record should pass validation');
        $this->assertTrue($review->save(), 'Record should be saved successfully');
        $this->assertNotNull($review->id, 'Record should have an ID after saving');

        // c. Ver se o registo válido se encontra na BD
        $review = Review::findOne(['description' => 'Valid description']);
        $this->assertNotNull($review, 'Record should exist in the database');

        // d. Ler o registo anterior e aplicar um update
        $review = Review::findOne(['description' => 'Valid description']);
        $review->description = 'Updated description';
        $this->assertTrue($review->save(), 'Record should be updated successfully');

        // e. Ver se o registo atualizado se encontra na BD
        $review = Review::findOne(['description' => 'Updated description']);
        $this->assertNotNull($review, 'Updated record should exist in the database');

        // f. Apagar o registo
        $review->delete();

        // Step g: Verify that the record is not in the database
        $this->assertNull(Review::findOne(['description' => 'Updated description']), 'Record should be deleted');
        $this->assertNull(Review::findOne(['description' => 'Updated description']), 'Record should not exist in the database');
    }
}
