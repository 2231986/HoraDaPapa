<?php


namespace frontend\tests\Unit;

use common\models\User;
use frontend\tests\UnitTester;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

        // a. Despoletar todas as regras de validação (introduzindo dados erróneos);

        // criar novo user
        $user = new \common\models\User();

        // inserção de dados invalidos
        $user->username = null; // Intentionally setting a required field to null
        $user->email = 'invalidemail'; // Providing an invalid email format
        $user->status = 'non_numeric_status'; // Setting a non-numeric value to a numeric field

        // guardar email
        $saved = $user->save();

        // confirmar que validaçao falhou
        $this->assertFalse($saved, 'Validation should fail');
        $this->assertNotEmpty($user->getErrors(), 'There should be validation errors');
    }


    //LifeCycle de Utilizador

    public function testCompleteUserLifecycle()
    {
        // b. Criar um registo válido e guardar na BD
        $user = new \common\models\User();
        $user->username = 'new_username';
        $user->email = 'new_email@example.com';
        $user->setPassword("12345678");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        // c. Ver se o registo válido se encontra na BD
        $savedUser = \common\models\User::findOne($user->id);
        $this->assertInstanceOf(\common\models\User::class, $savedUser, 'User should exist in the database');
        $this->assertEquals($user->username, $savedUser->username, 'Username should match');
        $this->assertEquals($user->email, $savedUser->email, 'Email should match');

        // d. Ler o registo anterior e aplicar um update
        $savedUser->username = 'updated_username';
        $savedUser->save();

        // e. Ver se o registo atualizado se encontra na BD
        $updatedUser = \common\models\User::findOne($savedUser->id);
        $this->assertInstanceOf(\common\models\User::class, $updatedUser, 'Updated user should exist in the database');
        $this->assertEquals($savedUser->username, $updatedUser->username, 'Username should match');

        // f. Apagar o registo
        $updatedUser->delete();

        // g. Verificar que o registo não se encontra na BD.
        $deletedUser = \common\models\User::findOne($updatedUser->id);
        $this->assertNull($deletedUser, 'User should not exist in the database after deletion');
    }
}
