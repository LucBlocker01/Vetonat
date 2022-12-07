<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Consultation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('consultationDesc')
            ->add('dateConsultation')
            ->add('motifConsultation')
            ->add('clinique')
            ->add('urgente')
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'nomAnimal',
                'required' => true,
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomAnimal', 'ASC');
                }, ]);

        // ->add('traitement')
        // ->add('veterinaire')
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
