<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AnimalFactory::createMany(150);
        $manager->flush();
    }
}
