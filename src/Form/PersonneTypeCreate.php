<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneTypeCreate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pnomPers', null, [
                'empty_data' => '', ])
            ->add('nomPers', null, [
                'empty_data' => '', ])
            ->add('villePers', null, [
                'empty_data' => '', ])
            ->add('CPPers', null, [
                'empty_data' => '', ])
            ->add('adrPers', null, [
                'empty_data' => '', ])
            ->add('telPers', TelType::class, [
                'empty_data' => '', ])
            ->add('loginPers', null, [
                'empty_data' => '', ])
            ->add('mdpPers', PasswordType::class, [
            'empty_data' => '', ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
