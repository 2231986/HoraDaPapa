<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnRoute(\Yii::$app->homeUrl);
        $I->see('Hora da Papa');
        $I->seeLink('Sobre nós');
        $I->click('Sobre nós');
        $I->see('Sobre o Nosso Restaurante');
    }
}
