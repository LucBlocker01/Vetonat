<?php

namespace App\Factory;

use App\Entity\Clinique;
use App\Repository\CliniqueRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Clinique>
 *
 * @method static Clinique|Proxy                     createOne(array $attributes = [])
 * @method static Clinique[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Clinique[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Clinique|Proxy                     find(object|array|mixed $criteria)
 * @method static Clinique|Proxy                     findOrCreate(array $attributes)
 * @method static Clinique|Proxy                     first(string $sortedField = 'id')
 * @method static Clinique|Proxy                     last(string $sortedField = 'id')
 * @method static Clinique|Proxy                     random(array $attributes = [])
 * @method static Clinique|Proxy                     randomOrCreate(array $attributes = [])
 * @method static Clinique[]|Proxy[]                 all()
 * @method static Clinique[]|Proxy[]                 findBy(array $attributes)
 * @method static Clinique[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 * @method static Clinique[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static CliniqueRepository|RepositoryProxy repository()
 * @method        Clinique|Proxy                     create(array|callable $attributes = [])
 */
final class CliniqueFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'nomClinique' => 'Vétonat',
            'CPClinique' => self::faker()->postcode(),
            'villeClinique' => self::faker()->city(),
            'telClinique' => '0326458912',
            'adrClinique' => self::faker()->streetAddress(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(CliniqueFixtures $clinique): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Clinique::class;
    }
}
