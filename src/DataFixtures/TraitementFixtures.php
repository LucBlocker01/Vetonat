<?php

namespace App\DataFixtures;

use App\Factory\TraitementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TraitementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        TraitementFactory::createMany(50);
        $manager->flush();
    }
}
