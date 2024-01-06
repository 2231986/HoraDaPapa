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

        $authManager = \Yii::$app->authManager;
        $authManager->assign($authManager->getRole(RbacController::$RoleClient), User::findOne(['username' => 'erau'])->id);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        //login, criar um favorito, Atualizar
        $I->amLoggedInAs(User::findByUsername('erau'));
        $I->amOnRoute('favorite/create');
        $I->see('Criar Favorito');
        $I->selectOption('select[name="Favorite[plate_id]"]', "2");
        $I->click('Guardar');
        $I->see('Atualizar');
        $I->click('Atualizar');
        $I->selectOption('select[name="Favorite[plate_id]"]', "1");
        $I->click('Guardar');
        // criar novo favorito e removelo
        $I->amOnRoute('favorite/create');
        $I->see('Criar Favorito');
        $I->selectOption('select[name="Favorite[plate_id]"]', "2");
        $I->click('Guardar');
        $I->see('Atualizar');
        $I->see('Remover');
        $I->click('Remover');
    }
}
