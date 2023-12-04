<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        //$I->amOnRoute(Url::toRoute('/site/index'));
        $I->amOnPage('/');
        $I->see('Hora da Papa');

        $I->seeLink('Sobre nós');
        $I->click('Sobre nós');
        $I->wait(2); // wait for page to be opened

        $I->see('Descubra a nossa história e paixão pela culinária.');
    }
}
