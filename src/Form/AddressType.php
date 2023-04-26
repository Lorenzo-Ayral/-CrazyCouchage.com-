<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Ville'
            ])
            ->add('street', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Rue'
            ])
            ->add('country', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Pays'
            ])
            ->add('zip', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Code postal'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
