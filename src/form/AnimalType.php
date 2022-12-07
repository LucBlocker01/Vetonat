<?php

namespace App\form;

use App\Entity\Animal;
use Doctrine\ORM\EntityRepository;
use http\Client;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', null, [
                'empty_data' => '', ])
            ->add('stereliser', null, [
                'empty_data' => '', ])
            ->add('ageAnimal', null, [
                'empty_data' => '', ])
            ->add('poidsAnimal', null, [
                'empty_data' => '', ])
            ->add('descriptionAnimal', null, [
                'empty_data' => '', ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
