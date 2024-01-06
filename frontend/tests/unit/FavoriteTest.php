<?php


namespace frontend\tests\Unit;

use common\models\Favorite;
use common\models\User;
use common\models\Plate;
use frontend\tests\UnitTester;




class FavoriteTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {
    }

    // Step a: Trigger validation errors
    public function testTriggerValidationErrors()
    {


        // Create a Favorite instance with erroneous data to trigger validation rules
        $favorite = new Favorite();

        // Set erroneous data to trigger validation rules
        $favorite->plate_id = null; // Intentionally setting a required field to null
        $favorite->user_id = 'non_numeric_user_id'; // Providing a non-numeric user ID
        $favorite->date_time = 'invalid_date_time'; // Setting an invalid date format

        // Attempt to save the model
        $saved = $favorite->save();

        // Check if validation failed
        $this->assertFalse($saved, 'Validation should fail');
        $this->assertNotEmpty($favorite->getErrors(), 'There should be validation errors');
    }

    public function testCreateValidRecord()
    {
        $this->tester->wantTo('Test the lifecycle of the Favorite model');;

        $user = new \common\models\User();
        $user->username = 'new_username';
        $user->email = 'new_email@example.com';
        $user->setPassword("12345678");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        // b. Criar um registo válido e guardar na BD
        $favorite = new Favorite();
        $favorite->user_id = $user->id; // Definir user válido existente na bd de testes senao da erro
        $favorite->plate_id = 1; // Definir prato existente 

        $this->assertTrue($favorite->validate(), 'Record should pass validation');
        $this->assertTrue($favorite->save(), 'Record should be saved successfully');
        $this->assertNotNull($favorite->id, 'Record should have an ID after saving');

        // c. Ver se o registo válido se encontra na BD
        $this->tester->seeRecord('common\models\Favorite', ['id' => $favorite->id]);



        // Alternativa ao metodo seeRecord do codeception
        //$favorite = Favorite::findOne(['id' => $favorite->id]);
        //$this->assertNotNull($favorite, 'Record should exist in the database');



        // d. Ler o registo anterior e aplicar um update
        $favorite = Favorite::findOne($favorite->id);
        $favorite->user_id = $user->id; // Definir user válido existente na bd de testes senao da erro
        $this->assertTrue($favorite->save(), 'Record should be updated successfully');

        // e. Ver se o registo atualizado se encontra na BD
        $this->tester->seeRecord('common\models\Favorite', ['id' => $favorite->id, 'user_id' => $user->id]); // Definir user válido existente na bd de testes senao da erro

        // f. Apagar o registo
        $favorite->delete();

        //verifica que foi mesmo apagado
        $this->assertNull(Favorite::findOne($favorite->id), 'Record should be deleted successfully');


        // g. Verificar que o registo não se encontra na BD.
        $this->tester->dontSeeRecord('common\models\Favorite', ['id' => $favorite->id]);
    }
}
