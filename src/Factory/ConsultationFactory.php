<?php

namespace App\Factory;

use App\Entity\Consultation;
use App\Repository\ConsultationRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Consultation>
 *
 * @method static Consultation|Proxy createOne(array $attributes = [])
 * @method static Consultation[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Consultation[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Consultation|Proxy find(object|array|mixed $criteria)
 * @method static Consultation|Proxy findOrCreate(array $attributes)
 * @method static Consultation|Proxy first(string $sortedField = 'id')
 * @method static Consultation|Proxy last(string $sortedField = 'id')
 * @method static Consultation|Proxy random(array $attributes = [])
 * @method static Consultation|Proxy randomOrCreate(array $attributes = [])
 * @method static Consultation[]|Proxy[] all()
 * @method static Consultation[]|Proxy[] findBy(array $attributes)
 * @method static Consultation[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Consultation[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ConsultationRepository|RepositoryProxy repository()
 * @method Consultation|Proxy create(array|callable $attributes = [])
 */
final class ConsultationFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $date = self::faker()->date().' '.self::faker()->time();
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'consultationDesc' => self::faker()->paragraph(),
            'dateConsultation' => $date,
            'motifConsultation' => self::faker()->sentence(15),
            'clinique' => self::faker()->boolean(),
            'urgente' => self::faker()->boolean(),

        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Consultation $consultation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Consultation::class;
    }
}
