<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;

class PlateTestCest
{

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }
    public function _before(FunctionalTester $I)
    {
        $user = User::find()->where(['id' => 2])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleCooker);
        $auth->assign($role,  $user->id);
        $I->amOnRoute('site/login');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');

        $I->fillField('#loginform-username', 'cooker');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');

        $I->see('Página Principal', 'h1');
        $I->dontSeeLink('Sign In', 'form button[type=submit]');
        $I->see('Pratos');

            
        $I->amOnRoute('/plate/create');
        $I->see('Criar Prato');
        $I->fillField('#plate-description', 'Carbonara com guancialle e pecorino');
        $I->fillField('#plate-price', 10.99);
        $I->fillField('#plate-title', 'Carbonara');
        $I->selectOption('select[name="Plate[supplier_id]"]', "1");


        $I->click('Guardar', 'form button[type=submit]');
        $I->amOnRoute('/plate/index');
        $I->see('Carbonara');




    }
}
