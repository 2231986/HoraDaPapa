<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;

/**
 * Class LoginCest
 */
class LoginCest
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
        $user = User::find()->where(['id' => 1])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleAdmin);
        $auth->assign($role,  $user->id);

        $user = User::find()->where(['id' => 2])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleCooker);
        $auth->assign($role,  $user->id);

        $user = User::find()->where(['id' => 3])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleWaiter);
        $auth->assign($role,  $user->id);

        $user = User::find()->where(['id' => 4])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleClient);
        $auth->assign($role,  $user->id);

        $I->amOnRoute('site/login');
    }

    public function loginAdmin(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');

        $I->fillField('#loginform-username', 'admin');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');

        $I->see('Página Principal', 'h1');
        $I->dontSeeLink('Sign In', 'form button[type=submit]');
    }

    public function loginCooker(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');

        $I->fillField('#loginform-username', 'cooker');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');

        $I->see('Página Principal', 'h1');
        $I->dontSeeLink('Sign In', 'form button[type=submit]');
    }

    public function loginWaiter(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');

        $I->fillField('#loginform-username', 'waiter');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');

        $I->see('Página Principal', 'h1');
        $I->dontSeeLink('Sign In', 'form button[type=submit]');
    }

    public function loginClient(FunctionalTester $I) //Não é suposto conseguir fazer login
    {
        $I->amOnRoute('/site/login');
        $I->see('Sign in to start your session', 'p');

        $I->fillField('#loginform-username', 'client');
        $I->fillField('#loginform-password', '12345678');
        $I->click('Sign In', 'form button[type=submit]');

        $I->dontSeeLink('Página Principal', 'h1');
        $I->see('Sign in to start your session', 'p');
    }
}
