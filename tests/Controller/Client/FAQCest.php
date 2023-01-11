<?php


namespace App\Tests\Controller\Client;

use App\Factory\PersonneFactory;
use App\Tests\Support\ControllerTester;

class FAQCest
{
    // tests
    public function tryToTest(ControllerTester $I)
    {
        $user = PersonneFactory::createOne([
            'roles' => ['ROLE_USER'],
        ]);
        $realUser = $user->object();
        $I->amLoggedInAs($realUser);
        $I->amOnPage('/client/faq');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Accueil Client');
    }
}
