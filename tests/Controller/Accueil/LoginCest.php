<?php

namespace App\Tests\Controller\Accueil;

use App\Factory\PersonneFactory;
use App\Tests\Support\ControllerTester;

class LoginCest
{
    public function indexLogin(ControllerTester $I): void
    {
        $I->amOnPage('/login');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Log in!');
        $I->assertEquals(['CONNEXION'], $I->grabMultiple('div.card-header'));
    }
}
