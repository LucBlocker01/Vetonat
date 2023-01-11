<?php

namespace App\Factory;

use App\Entity\Traitement;
use App\Repository\TraitementRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Traitement>
 *
 * @method static Traitement|Proxy                     createOne(array $attributes = [])
 * @method static Traitement[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Traitement[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Traitement|Proxy                     find(object|array|mixed $criteria)
 * @method static Traitement|Proxy                     findOrCreate(array $attributes)
 * @method static Traitement|Proxy                     first(string $sortedField = 'id')
 * @method static Traitement|Proxy                     last(string $sortedField = 'id')
 * @method static Traitement|Proxy                     random(array $attributes = [])
 * @method static Traitement|Proxy                     randomOrCreate(array $attributes = [])
 * @method static Traitement[]|Proxy[]                 all()
 * @method static Traitement[]|Proxy[]                 findBy(array $attributes)
 * @method static Traitement[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 * @method static Traitement[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static TraitementRepository|RepositoryProxy repository()
 * @method        Traitement|Proxy                     create(array|callable $attributes = [])
 */
final class TraitementFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'descTrait' => self::faker()->sentence(10),
            'medicament' => self::faker()->word,
            'alimentation' => self::faker()->word(5),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Traitement $traitement): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Traitement::class;
    }
}
