<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;

class HomeCest
{
    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkMainFunctionality(AcceptanceTester $I)
    {
        $userID = 4;

        //Efetuar login
        $I->amOnPage('/site/login');
        $I->wait(1);
        $I->see('Sign in to start your session');
        $I->submitForm('#login-form', $this->formParams('admin', '12345678'));
        $I->wait(2);
        $I->see('Visão Geral');

        //Meal
        $I->amOnPage('/meal/create');
        $I->wait(1);
        $dinnerID = $I->grabAttributeFrom('#meal-dinner_table_id option:nth-child(2)', 'value');
        $I->selectOption('#meal-dinner_table_id', $dinnerID);
        $I->submitForm('#w0', []);
        $I->wait(1);
        $I->see('Refeições');

        //Pedidos
        $I->amOnPage('/request/index');
        $I->wait(1);
        $I->click('Criar Pedido');
        $I->wait(1);
        $I->see('Criar Pedido');
        $mealID = $I->grabAttributeFrom('//select[@id="request-meal_id"]/option[last()]', 'value');
        $I->selectOption('#request-meal_id', $mealID);
        $I->submitForm('#w0', ['Request[user_id]' => $userID, 'Request[plate_id]' => '1', 'Request[quantity]' => '2', 'Request[isCooked]' => '1']);
        $I->wait(1);
        $I->click('Entregar');

        //Invoice
        $I->amOnPage('/invoice/create');
        $I->wait(1);
        $I->selectOption('#invoice-meal_id', $mealID);
        $I->submitForm('#w0',  ['Invoice[user_id]' => $userID]);
        $I->wait(1);
        $I->see('Faturas');
        $I->see('Caralhotas de Almeirim');

        //Dinner
        $I->amOnPage("dinner/update?id=$dinnerID");
        $I->selectOption('#dinner-isclean', '1');
        $I->submitForm('#w0', []);
        $I->wait(1);
        $I->see('Mudar estado');
    }
}
