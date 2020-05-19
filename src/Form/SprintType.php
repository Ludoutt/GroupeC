<?php

namespace App\Form;

use App\Entity\Sprint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SprintType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
              'label' => 'Titre',
              'attr' => [
                'class' => 'input-form']
            ])
            ->add('resume', TextareaType::class, [
              'label' => 'Description',
              'attr' => [
                'class' => 'textarea-form']
            ])
            ->add('dateStart', DateType::class, [
              'label' => 'Date de début',
              'attr' => [
                'class' => 'select-form']
            ])
            ->add('dateEnd', DateType::class, [
              'label' => 'Date de fin',
              'attr' => [
                'class' => 'select-form']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sprint::class,
        ]);
    }
}
