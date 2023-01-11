<?php


namespace App\Tests\Controller\Accueil;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testIndexDefault(ControllerTester $I): void
    {
        $I->amOnPage('/accueil');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Accueil Vetonat');
        $I->seeNumberOfElements('h3', 3);
    }
}
