<?php

namespace App\Factory;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Personne>
 *
 * @method static Personne|Proxy                     createOne(array $attributes = [])
 * @method static Personne[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Personne[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Personne|Proxy                     find(object|array|mixed $criteria)
 * @method static Personne|Proxy                     findOrCreate(array $attributes)
 * @method static Personne|Proxy                     first(string $sortedField = 'id')
 * @method static Personne|Proxy                     last(string $sortedField = 'id')
 * @method static Personne|Proxy                     random(array $attributes = [])
 * @method static Personne|Proxy                     randomOrCreate(array $attributes = [])
 * @method static Personne[]|Proxy[]                 all()
 * @method static Personne[]|Proxy[]                 findBy(array $attributes)
 * @method static Personne[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 * @method static Personne[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static PersonneRepository|RepositoryProxy repository()
 * @method        Personne|Proxy                     create(array|callable $attributes = [])
 */
final class PersonneFactory extends ModelFactory
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
    }

    protected function getDefaults(): array
    {
        return [
            'nomPers' => self::faker()->lastName(),
            'pnomPers' => self::faker()->firstName(),
            'villePers' => self::faker()->city(),
            'CPPers' => self::faker()->postcode(),
            'telPers' => self::faker()->phoneNumber(),
            'loginPers' => mb_strtolower(self::faker()->unique()->numerify('user-###')),
            'mdpPers' => 'test',
            'adrPers' => self::faker()->address(),
        ];
    }

    public function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            ->afterInstantiate(function (Personne $personne) {
                $personne->setPassword($this->passwordHasher->hashPassword($personne, $personne->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return Personne::class;
    }
}
