<?php


namespace App\Tests\Controller\Client;


use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function form(ControllerTester $I): void
    {
        $I->amOnPage('/client/create');

        $I->seeInTitle("Création Client");
        $I->see("Création d'un nouveau Client", 'h3');
    }
}
