<?php

namespace App\DataFixtures;

use App\Factory\ConsultationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TraitementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ConsultationFactory::createMany(50);
        $manager->flush();
    }
}
