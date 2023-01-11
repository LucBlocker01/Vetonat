<?php


namespace App\Tests\Controller\Veterinaire;

use App\Factory\ConsultationFactory;
use Codeception\PHPUnit\TestCase;
use PHPUnit\Framework\IncompleteTestError;
use App\Factory\PersonneFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{

    // tests
    public function testIndexDefault(ControllerTester $I): void
    {
        $user = PersonneFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
        ]);
        $realUser = $user->object();
        $I->amLoggedInAs($realUser);
        $I->amOnPage('/veterinaire/clients');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Vétérinaire - Clients');
    }

    public function testRefuse(ControllerTester $I): void
    {
        $user = PersonneFactory::createOne([
            'roles' => ['ROLE_USER'],
        ]);
        $realUser = $user->object();
        $I->amLoggedInAs($realUser);
        $I->amOnPage('/veterinaire/clients');
        $I->seeResponseCodeIs(403);
    }
}
