<?php

namespace App\Factory;

use App\Entity\Veterinaire;
use App\Repository\VeterinaireRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Veterinaire>
 *
 * @method static Veterinaire|Proxy                     createOne(array $attributes = [])
 * @method static Veterinaire[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Veterinaire[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Veterinaire|Proxy                     find(object|array|mixed $criteria)
 * @method static Veterinaire|Proxy                     findOrCreate(array $attributes)
 * @method static Veterinaire|Proxy                     first(string $sortedField = 'id')
 * @method static Veterinaire|Proxy                     last(string $sortedField = 'id')
 * @method static Veterinaire|Proxy                     random(array $attributes = [])
 * @method static Veterinaire|Proxy                     randomOrCreate(array $attributes = [])
 * @method static Veterinaire[]|Proxy[]                 all()
 * @method static Veterinaire[]|Proxy[]                 findBy(array $attributes)
 * @method static Veterinaire[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 * @method static Veterinaire[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VeterinaireRepository|RepositoryProxy repository()
 * @method        Veterinaire|Proxy                     create(array|callable $attributes = [])
 */
final class VeterinaireFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'personne' => PersonneFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Veterinaire $veterinaire): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Veterinaire::class;
    }
}
