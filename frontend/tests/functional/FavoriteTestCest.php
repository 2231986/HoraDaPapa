<?php


namespace frontend\tests\Functional;

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
        $I->see('logout (client)');                                         // verificaçao se nome de utilizador é visivel apos login
        $I->see('Favoritos');                                               // verificaçao se tab login fica disponivel apos login
        $I->click('Favoritos');
        $I->see('Criar Favorito');                                           // Valida se  botao "Criar Favorito" existe
        $I->click('Criar Favorito');                                         // Click  botao "Criar Favorito"
        $I->see('Criar Favorito');                                           // garantir que a pagina criar favorito é carregada
        $I->amOnPage('/favorite/create');                                   // estamos na pagina create
        $I->selectOption('select[name="Favorite[plate_id]"]', "2"); // Selecionar prato a partir de dropdownlist
        $I->click('Guardar');                                               // Click guardar para submeter form
        $I->seeInCurrentUrl('/favorite/view');                                  // Redirecionamento para a pagina de view
        $I->see('Atualizar');                                           // Assert that the view favorite page loads correctly
        $I->click('Atualizar');                                             // Click guardar para submeter form
        $I->selectOption('select[name="Favorite[plate_id]"]', "1");   // Selecionar prato a partir de dropdownlist
        $I->click('Guardar');                                                   // Click guardar para submeter form
        $I->see('Atualizar');                 //vejo o botao com o texto atualizar  (view correspondente ao favorito criado)
        $I->see('Remover');             // vejo o botao com o texto remover (view correspondente ao favorito criado)
        $I->click('Remover');
        $I->see('Criar Favorito'); //garante que o registo é apagado porque o utilizador é redirecionado para o index assim que apaga um registo, o processo nao e interrompido
    }
}
