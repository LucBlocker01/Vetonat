<?php

namespace App\Factory;

use App\Entity\Consultation;
use App\Repository\ConsultationRepository;
use DateInterval;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Consultation>
 *
 * @method static Consultation|Proxy                     createOne(array $attributes = [])
 * @method static Consultation[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Consultation[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Consultation|Proxy                     find(object|array|mixed $criteria)
 * @method static Consultation|Proxy                     findOrCreate(array $attributes)
 * @method static Consultation|Proxy                     first(string $sortedField = 'id')
 * @method static Consultation|Proxy                     last(string $sortedField = 'id')
 * @method static Consultation|Proxy                     random(array $attributes = [])
 * @method static Consultation|Proxy                     randomOrCreate(array $attributes = [])
 * @method static Consultation[]|Proxy[]                 all()
 * @method static Consultation[]|Proxy[]                 findBy(array $attributes)
 * @method static Consultation[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 * @method static Consultation[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ConsultationRepository|RepositoryProxy repository()
 * @method        Consultation|Proxy                     create(array|callable $attributes = [])
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
        $start = self::faker()->dateTimeBetween('-1 week', '+1 week');
        $end = (clone $start)->add(new DateInterval("PT2H"));
        $motif = json_decode(file_get_contents('src/DataFixtures/data/Motif.json'), true);

        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'consultationDesc' => self::faker()->sentence(15),
            'motifConsultation' => self::faker()->randomElement($motif)['name'],
            'clinique' => self::faker()->boolean(),
            'urgente' => self::faker()->boolean(),
            'start' => $start,
            'end' => $end ,
            'allday' => self::faker()->boolean(5),
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
