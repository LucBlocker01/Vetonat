<?php


namespace App\Tests\Controller\Veterinaire;

use App\Factory\ClientFactory;
use App\Factory\PersonneFactory;
use App\Tests\Support\ControllerTester;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\RemoteUserFactory;

class  ListClientCest
{
    /*
    public function testIndexDefault(ControllerTester $I): void
    {
        $user = PersonneFactory::createOne ([
            'roles' => ['ROLE_USER'],
        ]);
        $realUser = $user->object();
        $I->amLoggedInAs($realUser);
        $I->amOnPage('/veterinaire/clients');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Vétérinaire - Clients');
    }
    */
}
