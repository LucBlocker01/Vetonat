<?php

namespace App\DataFixtures;

use App\Factory\CliniqueFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CliniqueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CliniqueFactory::createOne();
        $manager->flush();
    }
}
