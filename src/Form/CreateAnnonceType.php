<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Annonce;
use App\Entity\Logement;

class CreateAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'annonce'])
            ->add('image', FileType::class, [
                'label' => 'Nom de l\'annonce'])
            ->add('image', FileType::class, [
                'label' => 'Image', // Étiquette du champ
                'required' => false, // Indique si le champ est obligatoire ou non
                'attr' => ['accept' => 'image/*'], // Filtre les fichiers pour n'accepter que les images
                // Autres options supplémentaires selon vos besoins
            ])
            ->add('description', TextareaType::class)
            ->add('price', IntegerType::class, [
                'label' => 'Prix'
            ])
            ->add('startAt', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])
            ->add('is_available', CheckboxType::class, [
                'attr' => ['class' => 'form-check-input'],
                'label' => 'Disponible ?'
            ])
            ->add('logement', EntityType::class, [
                'class' => Logement::class,
                'label' => 'Type de logement',
                'choice_label' => 'type'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'label' => 'Catégorie'
            ])
            ->add('address', AddressType::class, [
                'mapped' => true,
                'label' => 'Adresse'
            ])
            ->add('save', SubmitType::class, ['label' => 'Créer une annonce'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
