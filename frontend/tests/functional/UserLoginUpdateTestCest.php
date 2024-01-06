<?php


namespace frontend\tests\Functional;

use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;
use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;

class UserLoginUpdateTestCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'custom_data.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole(RbacController::$RoleClient), User::findOne(['username' => 'erau'])->id);

    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Registar');
        $I->fillField('input[id="signupform-username"]', 'client');
        $I->fillField('input[id="signupform-email"]', 'client@horadapapa.com');
        $I->fillField('input[id="signupform-password"]', '12345678');
        $I->click(['name' => 'signup-button']);

        $I->click('Login');
        $I->submitForm('#login-form', $this->formParams('client', '12345678'));

        $I->amOnPage('/');
        $I->see('Logout (client)');
        $I->see('Utilizador');
        $I->click('Utilizador');

        $I->see('client@horadapapa.com');
        $I->click('.team-item a.btn.btn-primary');

        $I->fillField(['name' => 'User[email]'], 'clientX@horadapapa.com');
        $I->click('Guardar');
        $I->see('clientX@horadapapa.com');
    }
}
