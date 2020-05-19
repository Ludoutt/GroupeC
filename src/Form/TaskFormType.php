<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\TaskTag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'input-form',
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('resume', TextareaType::class, [
                'attr' => [
                    'class' => 'textarea-form',
                    'placeholder' => 'Resume'
                ]
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Priorité' => 'priorité',
                    'Low' => 'low',
                    'Normal' => 'normal',
                    'Hight' => 'hight',
                ],
                'label' => 'Priorité',
                'attr' => [
                  'class' => 'select-form'
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Statut' => 'statut',
                    'Todo' => 'todo',
                    'Doing' => 'doing',
                    'Done' => 'done',
                ],
                'label' => 'Status',
                'attr' => [
                  'class' => 'select-form'
                ]
            ])
            ->add('tags', EntityType::class, [
                'class' => TaskTag::class,
                'choice_label' => 'label',
                'label' => 'Tag',
                'required' => false,
                'attr' => [
                  'class' => 'select-form'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
