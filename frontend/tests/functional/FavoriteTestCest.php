<?php


namespace frontend\tests\Functional;

use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;
use frontend\tests\FunctionalTester;
use yii\web\IdentityInterface;
use common\models\Favorite;

class FavoriteTestCest
{

    public function _before(FunctionalTester $I)
    {
        $user = User::find()->where(['id' => 4])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleClient);
        $auth->assign($role,  $user->id);
        $I->amOnRoute('site/login');



    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('input[id="loginform-username"]', 'client');
        $I->fillField('input[id="loginform-password"]', '12345678');
        $I->click('login-button');
        $I->amOnPage('/');
        $I->see('logout (client)');
        $I->see('Favoritos');
        $I->click('Favoritos');
        $I->see('Adicione');
        $I->amOnRoute('favorite/create');
        $I->see('Criar Favorito');
        $I->selectOption('select[name="Favorite[plate_id]"]', "2");
        $I->click('Guardar');
        $I->see('Atualizar');
        $I->click('Atualizar');
        $I->selectOption('select[name="Favorite[plate_id]"]', "1");
        $I->click('Guardar');// Click guardar para submeter form
        $I->amOnRoute('favorite/create');
        $I->see('Criar Favorito');
        $I->selectOption('select[name="Favorite[plate_id]"]', "2");
        $I->click('Guardar');
        $I->see('Atualizar');
        $I->see('Remover');
        $I->click('Remover');
    }
}
