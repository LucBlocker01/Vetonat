<?php

namespace App\DataFixtures;

use App\Factory\CliniqueFactory;
use App\Factory\VeterinaireFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VeterinaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        VeterinaireFactory::createMany(3, function () {
            return [
                'clinique' => CliniqueFactory::random(),
            ];
        });
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CliniqueFixtures::class,
        ];
    }
}
