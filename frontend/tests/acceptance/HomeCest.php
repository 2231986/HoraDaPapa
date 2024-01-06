<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;
use common\models\User;

class HomeCest
{
    public function _before(AcceptanceTester $I)
    {
        $user = User::findOne(['username' => 'dinis999']);

        if ($user)
        {
            $user->delete();
        }

        //TODO: Adicionar 1 prato
    }

    public function _after(AcceptanceTester $I)
    {
        $user = User::findOne(['username' => 'dinis999']);

        if ($user)
        {
            $user->delete();
        }

        //TODO: Apagar Favorito
    }

    public function checkFrontendGuess(AcceptanceTester $I)
    {
        //Home
        $I->amOnPage('/');
        $I->see('Hora da Papa');

        //About
        $I->seeLink('Sobre nós');
        $I->click('Sobre nós');
        $I->wait(2);
        $I->see('Descubra nosso delicioso cardápio e desfrute de uma maravilhosa experiência gastronômica.');

        //Reserva
        // $I->seeLink('Reserva');
        // $I->click('Reserva');
        // $I->wait(2);

        // $I->fillField('input[name="ContactForm[name]"]', 'Dinis Vala');
        // $I->fillField('input[name="ContactForm[email]"]', 'dinis@horadapapa.com');
        // $I->fillField('input[name="ContactForm[subject]"]', 'Almoço');
        // $I->fillField('textarea[name="ContactForm[body]"]', 'Gostava de almoçar às 14h');
        // TODO: Adicionar captcha

        // $I->click('Submit');
        // $I->see('Thank you for contacting us. We will respond to you as soon as possible.', '.alert-success');

        //Pratos
        $I->seeLink('Pratos');
        $I->click('Pratos');
        $I->wait(2);

        $I->see('Todas as papas!');
        $I->see('€', '.text-primary');

        //Registar
        $I->seeLink('Registar');
        $I->click('Registar');
        $I->wait(2);

        $I->fillField('input[name="SignupForm[username]"]', 'dinis999');
        $I->fillField('input[name="SignupForm[email]"]', 'dinis@horadapapa.com');
        $I->fillField('input[name="SignupForm[password]"]', '12345678');
        $I->fillField('input[name="SignupForm[name]"]', 'Dinis');
        $I->fillField('input[name="SignupForm[surname]"]', 'Vala');
        $I->fillField('input[name="SignupForm[nif]"]', '123456789');

        $I->submitForm('#form-signup', []);

        $I->wait(3);
        $I->see('Thank you for registration. Please check your inbox for verification email.', '.alert-success');
    }

    public function checkFrontendFavorites(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(1);
        $I->see('Hora da Papa');

        $I->see('Login');
        $I->click('Login');
        $I->wait(2);

        $I->fillField('input[name="LoginForm[username]"]', 'client');
        $I->fillField('input[name="LoginForm[password]"]', '12345678');

        $I->submitForm('#login-form', []);

        $I->wait(3);

        $I->seeLink('Favoritos');
        $I->click('Favoritos');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0, document.body.scrollHeight);");

        $I->waitForElement('a i.fa.fa-plus');
        $I->executeJS('document.querySelector("a i.fa.fa-plus").click();');
        $I->wait(2);

        $I->selectOption('select[name="Favorite[plate_id]"]', '1');

        $I->submitForm('#w0', []);

        $I->wait(1);

        $I->seeElement('.fa.fa-edit');
        $I->seeElement('.fa.fa-trash');
    }
}
