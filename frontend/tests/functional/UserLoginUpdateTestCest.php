<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class UserLoginUpdateTestCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Registar');
        $I->fillField('input[id="signupform-username"]', 'trunks');
        $I->fillField('input[id="signupform-email"]', 'trunks@corp.com');
        $I->fillField('input[id="signupform-password"]', '12345678');
        $I->click('signup-button');
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('input[id="loginform-username"]', 'trunks');
        $I->fillField('input[id="loginform-password"]', '12345678');
        $I->click('login-button');
        $I->amOnPage('/');
        $I->see('logout (trunks)');
        $I->see('Utilizador');
        $I->click('Utilizador');
        $I->see('trunks@corp.com');
        $I->seeLink('Atualizar');
        $I->click('Atualizar');
        $I->fillField('input[id="user-email"]', 'trunks@capsule.com');
        $I->click('Guardar');
        $I->see('trunks@capsule.com');
    }
}
