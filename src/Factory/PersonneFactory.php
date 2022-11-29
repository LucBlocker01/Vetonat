<?php

namespace App\Factory;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Personne>
 *
 * @method static Personne|Proxy createOne(array $attributes = [])
 * @method static Personne[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Personne[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Personne|Proxy find(object|array|mixed $criteria)
 * @method static Personne|Proxy findOrCreate(array $attributes)
 * @method static Personne|Proxy first(string $sortedField = 'id')
 * @method static Personne|Proxy last(string $sortedField = 'id')
 * @method static Personne|Proxy random(array $attributes = [])
 * @method static Personne|Proxy randomOrCreate(array $attributes = [])
 * @method static Personne[]|Proxy[] all()
 * @method static Personne[]|Proxy[] findBy(array $attributes)
 * @method static Personne[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Personne[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PersonneRepository|RepositoryProxy repository()
 * @method Personne|Proxy create(array|callable $attributes = [])
 */
final class PersonneFactory extends ModelFactory
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

        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Personne $personne): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Personne::class;
    }
}
