<?php

namespace App\Form;

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
use App\Entity\User; // Ajouter cette ligne pour importer l'entité User

class CreateAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('imageFile', FileType::class, [
                'label' => 'Image', // Étiquette du champ
                'required' => false, // Indique si le champ est obligatoire ou non
                'attr' => ['accept' => 'image/*'], // Filtre les fichiers pour n'accepter que les images
                // Autres options supplémentaires selon vos besoins
            ])
            ->add('description', TextareaType::class)
            ->add('price', IntegerType::class)
            ->add('startAt', DateType::class, [
                'label' => 'Start Date',
                'widget' => 'single_text',
            ])
            ->add('endAt', DateType::class, [
                'label' => 'End Date',
                'widget' => 'single_text',
            ])
            ->add('is_available', CheckboxType::class, [
                'label' => 'Disponible', // Étiquette de la case à cocher
                'required' => false, // Indique si la case à cocher est obligatoire ou non
                'attr' => ['class' => 'custom-class'], // Attributs HTML supplémentaires pour la case à cocher
                // Autres options supplémentaires selon vos besoins
            ])
            ->add('logement', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
            ])
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Annonce'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
