<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use App\Factory\ConsultationFactory;
use App\Factory\TraitementFactory;
use App\Factory\VeterinaireFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConsultationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        ConsultationFactory::createMany(50, function () {
            return [
                'traitement' => TraitementFactory::random(),
                'animal' => AnimalFactory::random(),
                'veterinaire' => VeterinaireFactory::random(),
            ];
        });
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TraitementFixtures::class,
            AnimalFixtures::class,
            VeterinaireFixtures::class,
        ];
    }
}
