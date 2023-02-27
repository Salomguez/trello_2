<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
            ->add('updated_at')
            ->add('completed_at')
            ->add('status',ChoiceType::class, [
                'choices'  => [
                    'NOUVEAU' => 'Nouveau',
                    'EN COURS' => 'En cours',
                    'TRAITÉ' => 'Traité',
                ],
                'expanded' => false,
                'multiple' => false,
                ])
            ->add('utilisateurs', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'email',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
