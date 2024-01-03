<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;

class MealTestCest
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
        $user = User::find()->where(['id' => 3])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleWaiter);
        $auth->assign($role,  $user->id);
        $I->amOnRoute('site/login');

    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');
        $I->fillField('#loginform-username', 'waiter');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');
        $I->see('Página Principal', 'h1');
        $I->amOnRoute('/meal/create');
        $I->selectOption('select[name="Meal[dinner_table_id]"]', "2"); // Selecionar prato a partir de dropdownlist
        $I->fillField('input[id="meal-checkout"]', '0');
        $I->click('Guardar');
        $I->see('Atualizar');
        $I->click('Atualizar');
        $I->fillField('input[id="meal-checkout"]', '1');
        $I->click('Guardar');
    }
}
