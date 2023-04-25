<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
            ->add('description', TextareaType::class)
            ->add('price', MoneyType::class)
            ->add('startAt', DateType::class)
            ->add('endAt', DateType::class)
            ->add('is_available', CheckboxType::class)
            ->add('logement', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class, // Définir la classe de l'entité Category
                'choice_label' => 'label', // Définir le champ à afficher comme label dans le formulaire
                /*'query_builder' => function (EntityRepository $er) {
                    // Définir la requête de récupération des catégories depuis la base de données
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },*/
            ])
           ->add('user', EntityType::class, [
                'class' => User::class, // Définir la classe de l'entité User
                'choice_label' => 'username', // Définir le champ à afficher comme label dans le formulaire
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
