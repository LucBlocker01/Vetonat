<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', textType::class, [
                'empty_data' => '', ])
            ->add('EspeceAnimal', textType::class, [
                'empty_data' => '', ])
            ->add('stereliser', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,]])
            ->add('ageAnimal', IntegerType::class, [
                'empty_data' => '', ])
            ->add('poidsAnimal', NumberType::class, [
                'empty_data' => '', ])
            ->add('descriptionAnimal', TextareaType::class, [
                'empty_data' => '', ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
